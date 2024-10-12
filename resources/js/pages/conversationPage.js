export const conversationPage = () => ({

    post() {
        return this.$store.api.conversation
    },

    async init() {
        this.$store.api.setQueryId()
        await this.$store.api.setConversation()
        this.post = this.$store.api.conversation
        this.$store.api.loading = false
    }
})