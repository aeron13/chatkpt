<x-modal name="confirm-conversation-deletion" :show="false" onClose="" onOpen="">
    <x-form-box class="px-2" title="Are you sure?">
            <div x-data="deleteConversationForm" class="mt-12 flex flex-wrap gap-3 pb-10">
                <x-secondary-button x-on:click="$dispatch('close')" class="w-fit">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button @click="handleSubmit" class="justify-center w-fit">
                    <span x-show="sending">
                        <x-spinner />
                    </span>
                    <span x-text="sending ? 'Deleting' : 'Yes, delete' ">
                    </span>
                </x-primary-button>
            </div>
    </x-form-box>
</x-modal>

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