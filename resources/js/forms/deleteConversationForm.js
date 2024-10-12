export const deleteConversationForm = () => ({
    
    sending: false,

    async handleSubmit(event) {

        this.$event.preventDefault()
        if (!this.sending) {
            this.sending = true

            await fetch('/api/conversations/' + this.$store.api.queryId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.$store.csrf.token,
                },
            })
            .then((response) => response.json())
            .then(data => {
                console.log(data)
                if (data.errors) {
                    this.error = data.message
                } else {
                    this.sending = false
                    window.location.href = '/dashboard';
                }
            })
            .catch((error) => {
                console.log(error)
            });
        }

    },
})