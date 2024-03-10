<div 
    x-data="hasModal" 
    @open-update-modal.window="openModal($event.detail)" 
    @close-update-modal.window="closeModal()"
    x-show="!$store.api.loading && $store.api.conversations.length > 0" 
    x-transition.opacity 
>
    <template x-for="(timespan, index) in $store.api.orderedConversations" :key="index">
        <div x-show="timespan.posts.length > 0" class="mt-[28px]">
            <h6 class="font-sans lg:font-light text-sm lg:text-base dark:text-light mb-[15px]" x-text="timespan.timespan"></h6>
            <ul class="grid lg:grid-cols-2 gap-2 lg:gap-4 mb-[40px]">
                <template x-for="post in timespan.posts" :key="post.id">
                    <a x-bind:href="post.url">
                        <li class="rounded-2xl bg-lightglass-1 dark:bg-glass-1 rounded-xl py-[8px] lg:py-[16px] pl-[13px] lg:pl-[25px] pr-[8px] lg:pr-[16px] border border-[0.5px] border-[#C9C9C9] dark:border-[#868686] lg:h-[162px] transform hover:rotate-[-1deg] transition-transform duration-500" >
                            <div class="w-full h-full flex flex-col justify-between items-end">
                                <p class="w-full font-special text-xl lg:text-2xl font-medium dark:text-light mb-[20px] mt-[5px] pr-[16px] lg:m-0 lg:p-0" x-text="post.title"></p>
                                <div class="w-full flex relative gap-2 items-center">
                                    <template x-for="cat in post.categories">
                                        <div 
                                            class="origin-top-left rotate-[-4.45deg] transform md:translate-x-[-10px]"
                                            x-bind:class="cat.parent_id ? 'w-[13px] h-[13px] lg:w-[20px] lg:h-[20px] rounded-[4px]' : 'rounded-[5px] w-[20px] h-[20px] lg:w-[32px] lg:h-[32px]' " 
                                            x-bind:style="`background-color: ${cat.color}`"
                                        >
                                        </div>
                                    </template>
                                    <button @click.prevent="$dispatch('open-update-modal', post.id)" class="add-icon w-[18px] h-[18px] lg:w-[23px] lg:h-[23px] absolute right-0 bottom-0 transform hover:scale-[1.1] transition-transform" style="background-image: url({{ asset('icons/plus-icon.svg') }})"></button>
                                </div>
                            </div>
                        </li>
                    </a>
                </template>
            </ul>
        </div>
    </template>

    <x-modal name="update-conversation" :show="false" onClose="" focusable onOpen="">
        <x-form-box :title="'Add category'" class="mx-0">
            <p class="font-sans dark:text-light text-[15px] mt-[36px]">Add a category to:</p>
            <p class="font-special dark:text-light text-xl lg:text-2xl" x-text="$store.api.conversation.title"></p>
            @include('partials/update-conversation')
        </x-form-box>
    </x-modal>
</div>


<script type="text/javascript">

    document.addEventListener('alpine:init', () => {

        Alpine.data('hasModal', () => ({

            async openModal(post_id) {
                this.$event.preventDefault(); 
                await this.$store.api.setConversation(post_id)
                this.$dispatch('update-cat-select')
                this.$dispatch('open-modal', 'update-conversation')
                this.$store.api.categoryList.length == 0 && this.$dispatch('toggle-create-form', true)
            },

            closeModal() {
                this.$dispatch('reset-data')
                this.$dispatch('close-modal', 'update-conversation')
            },

        }))

    })
</script>