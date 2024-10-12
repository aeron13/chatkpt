export const createCategoryForm = () => ({
    
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
    },

    isValid() {
        if (!this.category.name || !this.category.color) return false
        return true
    },

    async handleSubmit(event) {

        this.$event.preventDefault()

        if (this.isValid() && !this.sending) {

            this.sending = true

            await fetch('/api/categories', {
                method: 'POST',
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

    async handlePositiveSubmit(category_id) {

        await this.$store.api.setCategories()

        this.sending = false
        
        this.$dispatch('update-cat-select')
        if (this.category.parent_id) this.$dispatch('toggle-category', [this.category.parent_id, category_id])
        else this.$dispatch('toggle-category', [category_id])

        this.category.name = null
        this.category.parent_id = null
        this.showCreateForm = false
    }
    
})