<x-app-layout>
    <div x-data="category">
        <div class="mx-[20px] lg:mx-[35px] grid lg:grid-cols-12 pt-[162px]">
            @include('partials/sidebar')
            <div class="lg:col-start-4 lg:col-end-12 pb-[100px]" >
                <div class="flex justify-between items-center gap-6 lg:gap-10 mb-12 transform translate-y-[-6px]">
                    <div class="flex items-center gap-2">
                        <span class="w-[17px] h-[17px] rotate-[-4.45deg] rounded-[4px] mt-2" x-bind:style="`background-color: ${$store.api.category.color}`"></span>
                        <h6 class="font-special font-medium text-[32px] leading-tight lg:text-[40px] dark:text-light" x-text="$store.api.category.name"></h6>
                    </div>
                    <div class="mb-1">
                        <x-oneline-menu>
                            <x-oneline-item>
                                <span @click="$dispatch('toggle-update-form'); $dispatch('close-oneline-menu')" class="cursor-pointer hover:font-bold">Edit</span>
                            </x-oneline-item>
                            <x-oneline-item class="font-sans text-base font-medium text-dark px-[13px] pb-[6px] pt-[5px]">
                                <span @click="$dispatch('open-modal', 'confirm-category-deletion' ); $dispatch('close-oneline-menu')" class="cursor-pointer hover:text-magenta hover:font-bold">Delete</span>
                            </x-oneline-item>
                        </x-oneline-menu>
                    </div>
                </div>
                @include('partials/conversations-list')
            </div>
        </div>
    </div>
    <x-forms.update-category />
    <x-forms.delete-category />
</x-app-layout>

<script type="text/javascript">

    document.addEventListener('alpine:init', () => {

        Alpine.data('category', () => ({
            async init() {
                this.$store.api.setQueryId()
                await this.$store.api.setConversations()
                this.$store.api.loading = false
            }
        }))

    })
</script>