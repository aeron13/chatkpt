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