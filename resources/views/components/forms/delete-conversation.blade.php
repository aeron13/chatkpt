<span x-data="deleteConversationForm" x-on:click="handleSubmit" class="cursor-pointer hover:text-magenta hover:font-bold">Delete</span>

<script>
    document.addEventListener('alpine:init', () => {
        
        Alpine.data('deleteConversationForm', () => ({

            async handleSubmit(event) {

                this.$event.preventDefault()

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
                        this.handlePositiveSubmit()
                    }
                })
                .catch((error) => {
                    console.log(error)
                });

            },

            async handlePositiveSubmit() {
                // await this.$store.api.setConversations()
                window.location.href = '/dashboard'
            }


        }))

    })
</script>