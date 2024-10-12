export const updateCategoryForm = () => ({
    
    showUpdateForm: false,
    colors: [
        {'hue': 'Green', 'hex': '#10D9A3'},
        {'hue': 'Magenta', 'hex': '#EF466F'},
        {'hue': 'Yellow', 'hex': '#FFC43D'},
        {'hue': 'Blue', 'hex': '#0F708B'},
        {'hue': 'Purple', 'hex': '#8797F5'},
    ],
    category: {
        name: null,
        color: null,
        parent_id: null,
    },
    error: '',
    sending: false,

    init() {
        this.category.color = this.colors[0].hex

        this.$watch('showUpdateForm', (opened) => {
            if (opened) {
                this.category.name = this.$store.api.category.name
                this.category.color = this.$store.api.category.color
                this.category.parent_id = this.$store.api.category.parent_id
            }
        })
    },

    isValid() {
        if (!this.category.name || !this.category.color) return false
        return true
    },

    async handleSubmit(event) {

        this.$event.preventDefault()

        if ( this.isValid() && !this.sending ) {

            this.sending = true

            await fetch('/api/categories/' + this.$store.api.queryId, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.$store.csrf.token,
                },
                body: JSON.stringify(this.category),
            })
            .then((response) => response.json())
            .then(data => {
                console.log(data)
                if (data.errors) {
                    this.error = data.message
                } else {
                    this.handlePositiveSubmit(data.id)
                }
            })
            .catch((error) => {
                console.log(error)
            });

        } else {
            this.error = 'Some fields are missing. Check and try again'
        }
    },

    async handlePositiveSubmit() {
        await this.$store.api.setCategories()
        await this.$store.api.setConversations()
        
        this.sending = false
        this.showUpdateForm = false

        this.category.name = null
        this.category.parent_id = null
        this.showCreateForm = false
    }
})