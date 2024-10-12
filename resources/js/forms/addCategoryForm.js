import { Category } from "../classes/Category"

export const addCategoryForm = () => ({
    
    selectCategories: [],
    selectedCategories: [],
    error: '',
    sending: false,

    updateSelectCategories() {

        const conversation = this.$store.api.conversation
        
        if (conversation.categories) {
            this.selectedCategories = conversation.categories.map(cat => cat.id)
        }

        this.selectCategories = this.$store.api.categoryOrderedList.map(storeCat => {

            let children = storeCat.children.map(obj => {
                return new Category(obj, null, this.selectedCategories.find(x => x == obj.id))
            })

            return new Category(storeCat, children, this.selectedCategories.find(x => x == storeCat.id))
        })
    },

    resetData() {
        this.selectCategories = []
        this.selectedCategories = []
    },

    toggleCategory(ids) {

        const category = this.selectCategories.find(x => x.id == ids[0])
        const idIndex = this.selectedCategories.findIndex(x => x == ids[0])

        if (ids.length > 1) {

            const child = category.children.find(x => x.id == ids[1])
            child.selected = !child.selected;

            if (child.selected) {

                this.selectedCategories.push(ids[1])

                if (idIndex == -1) {
                    category.selected = true;
                    this.selectedCategories.push(ids[0])
                }

            } else {
                this.selectedCategories.splice(this.selectedCategories.findIndex(x => x == ids[1]), 1)
            }

        } else {
            category.selected = !category.selected;
            if (idIndex != -1 ) this.selectedCategories.splice(idIndex, 1)
            else this.selectedCategories.push(ids[0])
        }
    },

    isValid() {
        // if ( this.selectedCategories.length < 1 ) return false
        return true
    },

    async handleSubmit(event) {

        event.preventDefault()

        if (this.isValid() && !this.sending ) {

            this.sending = true

            await fetch('/api/conversations/' + this.$store.api.conversation.id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.$store.csrf.token,
                },
                body: JSON.stringify({'categories': this.selectedCategories}),
            })
            .then((response) => response.json())
            .then(data => {
                if (data.errors) {
                    this.error = data.message
                } else {
                    this.handlePositiveSubmit()
                }
            })
            .catch((error) => {
                console.log(error)
                this.error = error
            });

        } else {
            this.error = 'Some fields are missing. Check and try again'
        }
        this.sending = false
    },

    async handlePositiveSubmit() {
        if (this.$store.api.conversation.id != this.$store.api.queryId ) {
            await this.$store.api.setConversations()
            this.$dispatch('reset-data');
        } else {
            await this.$store.api.setConversation()
            await this.$store.api.setCategories()
            this.$dispatch('update-cat-select');
        }
        this.$dispatch('close-modal', 'update-conversation')
    }
})