<x-modal name="confirm-category-deletion" :show="false" onClose="">
    <x-form-box class="" title="Are you sure?">
            <div x-data="deleteCategoryForm" class="mt-12 flex flex-col-reverse lg:flex-row flex-wrap gap-10 lg:gap-3 pb-10">
                <x-secondary-button x-on:click="$dispatch('close')" class="w-fit">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button @click="handleSubmit">
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
        
        Alpine.data('deleteCategoryForm', () => ({
            sending: false,

            async handleSubmit(event) {

                this.$event.preventDefault()
                this.sending = true

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
                        this.sending = false
                        window.history.back();
                    }
                })
                .catch((error) => {
                    console.log(error)
                });

            },

        }))

    })
</script>