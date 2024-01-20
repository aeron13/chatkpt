<span x-data="deleteCategoryForm" x-on:click="handleSubmit" class="cursor-pointer hover:text-magenta hover:font-bold">Delete</span>

<script>
    document.addEventListener('alpine:init', () => {
        
        Alpine.data('deleteCategoryForm', () => ({

            async handleSubmit(event) {

                this.$event.preventDefault()

                await fetch('/api/categories/' + this.$store.api.queryId, {
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
                        window.location.href = '/dashboard'
                    }
                })
                .catch((error) => {
                    console.log(error)
                });

            },

        }))

    })
</script>