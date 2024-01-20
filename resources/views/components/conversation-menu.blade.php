<x-dropdown :align="'right'" width="140" showArrow="false">
    <x-slot name="trigger">
        <!-- <span class="text-white">edit</span> -->
        <div class="flex flex-col">
            <span class="w-[22px] h-[1px] bg-light rounded"></span>
            <span class="w-[22px] h-[1px] bg-light rounded mt-1"></span>
            <span class="w-[22px] h-[1px] bg-light rounded mt-1"></span>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="">
                <x-dropdown-link x-data="deleteConversationForm">
                    <span x-on:click="handleSubmit" class="cursor-pointer hover:text-magenta hover:font-bold">Delete</span>
                </x-dropdown-link>
            </form>
        </div>
    </x-slot>

</x-dropdown>

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