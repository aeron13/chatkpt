export const categoryPage = () => ({
    async init() {
        this.$store.api.setQueryId()
        await this.$store.api.setConversations()
        this.$store.api.loading = false
    }
})