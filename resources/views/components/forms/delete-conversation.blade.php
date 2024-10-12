<x-ui.modal name="confirm-conversation-deletion" :show="false" onClose="" onOpen="">
    <x-wrappers.form class="px-2" title="Are you sure?">
            <div x-data="deleteConversationForm" class="mt-12 flex flex-wrap gap-3 pb-10">
                <x-buttons.secondary x-on:click="$dispatch('close')" class="w-fit">
                    {{ __('Cancel') }}
                </x-buttons.secondary>

                <x-buttons.primary @click="handleSubmit" class="justify-center w-fit">
                    <span x-show="sending">
                        <x-ui.spinner />
                    </span>
                    <span x-text="sending ? 'Deleting' : 'Yes, delete' ">
                    </span>
                </x-buttons.primary>
            </div>
    </x-wrappers.form>
</x-ui.modal>

<script>
    document.addEventListener('alpine:init', () => {
        
        Alpine.data('deleteConversationForm', () => ({
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
        }))

    })
</script>