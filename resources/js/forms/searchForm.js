export const searchForm = () => ({

    query: null,
    error: '',
    sending: false,

    async handleSubmit(event) {
        
        if (!this.sending) {
            this.sending = true

            const response = await fetch(`/api/conversations?q=${this.query}`)
            const data = await response.json()
            
            this.$store.api.setConversations(data.data)
            this.sending = false
        }
    },
    
})