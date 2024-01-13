import './bootstrap';
import Alpine from 'alpinejs';
import showdown from 'showdown';

window.Alpine = Alpine;

Alpine.store('api', {

    loading: true,
    categoryList: [],
    categoryOrderedList: [],
    conversations: [],
    category: [],
    queryId: null,

    setQueryId() {
        let queryString = window.location.href
        this.queryId = queryString.substring(queryString.lastIndexOf('/') + 1)
    },
 
    async getConversations() {
        try {
            const response = await fetch('/api/conversations')
            const data = await response.json()
            return data.data
        } catch (error) {
            return error
        }
    },

    async getCategories() {
        try {
            const response = await fetch('/api/categories')
            const data = await response.json()
            return data.data
        } catch (error) {
            return error
        }
    },

    async getCategoryConversations(cat_id) {
        try {
            const response = await fetch('/api/categories/' + cat_id)
            const data = await response.json()
            return [data.conversations, data.category]
        } catch (error) {
            return error
        }
    },

    async getConversation() {
        try {
            const response = await fetch('/api/conversations/' + this.queryId)
            const data = await response.json()
            let post = data.data

            const converter = new showdown.Converter();
            post.messages.forEach(msg => {
                let htmlContent = '';
                msg.content.parts.forEach(part => {
                    htmlContent = htmlContent + '<p>' + converter.makeHtml(part) + '</p>';
                })
                msg.html = htmlContent;
            })

            return post

        } catch (error) {
            return error
        }
    },

    async setCategories() {
        this.categoryList = await this.getCategories()
        // 1. if the first element is top-level
        // 2. query all the elements that have that parent
        // 3. insert them in the array

        this.categoryOrderedList = this.categoryList.filter(cat => !cat.parent_id)
        
        // this.categoryList.forEach(cat => {
        //     if (!cat.parent_id) {
        //         let children = this.categoryList.filter(obj => obj.parent_id === cat.id)
        //         this.categoryOrderedList.push(cat)
        //         if (children.length > 1) children.forEach(child => {
        //             this.categoryOrderedList.push(child)
        //         })
        //     }
        // });
    },

    async setConversations() {
        if (this.queryId) {
            [this.conversations, this.category] = await this.getCategoryConversations(this.queryId)
        } else {
            this.conversations = await this.getConversations()
        }
    },

})

Alpine.store('csrf', {
    token: null,

    init() {
        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
})

Alpine.start();