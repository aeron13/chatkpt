import './bootstrap';
import Alpine from 'alpinejs';
import showdown from 'showdown';

window.Alpine = Alpine;

Alpine.store('api', {

    loading: true,
    categoryList: [],
    categoryOrderedList: [],
    conversations: [],
    orderedConversations: [],
    category: [],
    conversation: {},
    queryId: null,

    setQueryId() {
        let queryString = window.location.href
        this.queryId = queryString.substring(queryString.lastIndexOf('/') + 1)
    },

    initOrderedConversations() {
        return [
            { timespan: 'Today', posts: [] },
            { timespan: 'Yesterday', posts: [] },
            { timespan: 'This week', posts: [] },
            { timespan: 'This month', posts: [] },
            { timespan: 'Last month', posts: [] },
            { timespan: 'This year', posts: [] },
            { timespan: 'Last year', posts: [] },
            { timespan: 'Older', posts: [] },
        ]
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

    async getConversation(id = null) {
        let queryId = id ?? this.queryId
        try {
            const response = await fetch('/api/conversations/' + queryId)
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

    async setConversation(id = null) {
        if (id && this.conversations.length > 0) {
            this.conversation = this.conversations.find(obj => obj.id === id)
        } else {
            this.conversation = await this.getConversation(id)
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

    async setConversations(data = null) {
        if (data) {
            this.conversations = data
        } else {
            if (this.queryId) {
                [this.conversations, this.category] = await this.getCategoryConversations(this.queryId)
            } else {
                this.conversations = await this.getConversations()
            }
        }
        this.orderConversations(this.conversations)
    },

    orderConversations(conversations) {
        this.orderedConversations = this.initOrderedConversations()

        const today = new Date();
        conversations.forEach(post => {

            const date = new Date(post.create_time);

            if (today.getFullYear() === date.getFullYear()) {
                if (today.getMonth() === date.getMonth()) {

                    if (today.getDate() === date.getDate()) {
                        //today
                        this.orderedConversations[0].posts.push(post)

                    } else if (today.getDate() === date.getDate() + 1) {
                        // yesterday
                        this.orderedConversations[1].posts.push(post)

                    } else if (today.getDate() - date.getDate() < 7 ) {
                        // this week
                        this.orderedConversations[2].posts.push(post)
                    }
                    else {
                        // this month
                        this.orderedConversations[3].posts.push(post)
                    }

                } else if(today.getMonth() === date.getMonth() + 1) {
                    // last month
                    this.orderedConversations[4].posts.push(post)
                }
                else {
                    //this year
                    this.orderedConversations[5].posts.push(post)
                }

            } else if ( today.getFullYear() === date.getFullYear() + 1 ) {
                //last year
                this.orderedConversations[6].posts.push(post)

            } else {
                this.orderedConversations[7].posts.push(post)
            }

        })

    },

})

Alpine.store('csrf', {
    token: null,

    init() {
        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
})

Alpine.start();