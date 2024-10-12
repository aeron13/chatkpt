export const dashboardPage = () => ({

    empty: true,

    async init() {
        await this.$store.api.setConversations()
        this.$store.api.loading = false
        if (this.$store.api.conversations.length > 0) this.empty = false
    }

})