export const sidebar = () => ({
    async init() {
        await this.$store.api.setCategories()
    }
})