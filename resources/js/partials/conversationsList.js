export const conversationsList = () => ({

    async openModal(post_id) {
        this.$event.preventDefault(); 
        await this.$store.api.setConversation(post_id)
        this.$dispatch('update-cat-select')
        this.$dispatch('open-modal', 'update-conversation')
        this.$store.api.categoryList.length == 0 && this.$dispatch('toggle-create-form', true)
    },

    closeModal() {
        this.$dispatch('reset-data')
        this.$dispatch('close-modal', 'update-conversation')
    },

})