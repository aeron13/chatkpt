<x-ui.modal name="confirm-category-deletion" :show="false" onClose="" onOpen="">
    <x-wrappers.form class="" title="Are you sure?">
            <div x-data="deleteCategoryForm" class="mt-12 flex flex-col-reverse lg:flex-row flex-wrap gap-10 lg:gap-3 pb-10">
                <x-buttons.secondary x-on:click="$dispatch('close')" class="w-fit">
                    {{ __('Cancel') }}
                </x-buttons.secondary>

                <x-buttons.primary @click="handleSubmit" class="justify-center">
                    <span x-show="sending">
                        <x-ui.spinner />
                    </span>
                    <span x-text="sending ? 'Deleting' : 'Yes, delete' ">
                    </span>
                </x-buttons.primary>
            </div>
    </x-wrappers.form>
</x-ui.modal>