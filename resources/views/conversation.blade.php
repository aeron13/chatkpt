<x-app-layout>
    <div class="mx-[15px] lg:mx-[35px] grid grid-cols-12 pt-[150px] lg:pt-0">
        <div class="lg:pt-[162px]">
            @include('partials/sidebar')
        </div>
        <div class="col-span-12 lg:col-start-4 pb-[100px] lg:pt-[162px]" x-data="conversation" >

                <div class="ml-2 mb-[90px] lg:mb-[50px] transform lg:translate-y-[-6px]">
                    <div class="w-full flex flex-col-reverse lg:flex-row lg:justify-between lg:items-center">
                        <h1 class="font-special text-[32px] leading-tight lg:text-[40px] dark:text-light" x-text="post.title"></h1>
                        <div class="flex w-full md:w-fit justify-between lg:flex-row-reverse lg:justify-end items-center mb-[20px] lg:mb-0">
                            <p x-text="post.create_time" class="font-sans dark:text-light text-xs opacity-50 lg:text-sm text-right"></p>
                            <div class="absolute lg:relative right-0 lg:mr-3">
                                <x-oneline-menu>
                                    <x-oneline-item>
                                        <span class="cursor-pointer" @click="$dispatch('open-modal', 'update-conversation')">Edit</span>
                                    </x-oneline-item>
                                    <x-oneline-item>
                                        <x-forms.delete-conversation />
                                    </x-oneline-item>
                                </x-oneline-menu>
                            </div>
                        </div>
                    </div>
                    <template x-if="post.categories">
                        <div class="lg:hidden font-sans dark:text-light text-base mt-4 lg:mt-2">
                            <p>In: 
                                <template x-for="(cat, index) in post.categories">
                                    <span class="font-special font-bold">
                                        <a x-bind:href="`/category/${cat.id}`" x-text="cat.name"></a><span x-show="post.categories.length > 1 && index != post.categories.length - 1">,</span> 
                                    </span>
                                </template>
                            </p>
                        </div>
                    </template>
                </div>

                <div class="flex flex-col gap-y-4 lg:gap-y-0">
                    <template x-for="(msg, index) in post.messages" :key="">
                        <div>
                            <template x-if="index == 0">
                                <div class="z-0 fixed w-[66px] h-[66px] rotate-[-4.45deg] rounded-[9px] transform translate-x-[-20px] lg:translate-x-[-15px] translate-y-[-12px]" x-bind:style="post.categories && `background-color: ${post.categories[0].color}`"></div>
                            </template>
                            <div x-bind:class="`relative z-1 p-[20px] lg:pt-[24px] lg:px-[30px] lg:pb-[37px] rounded-[16px] mb-[21px] max-w-[960px] backdrop-blur-[28.73px] ${ msg.author === 'user' && 'border border-[#c3baba] dark:border-[#868686] border-[0.5px] bg-lightglass-1 dark:bg-glass-1' }`">
                                <div class="font-sans flex items-center mb-1 lg:mb-6">
                                    <span class="inline-block w-[20px] h-[20px] lg:w-[26px] lg:h-[26px] rounded-full mr-2 lg:mr-3"  x-bind:style="`background-color: ${ post.categories && msg.author === 'user' ? post.categories[0].color : '#E5E8DB' }`"></span>
                                    <p class="dark:text-light text-lg font-bold" x-text="msg.author === 'user' ? 'You' : msg.author"></p>   
                                </div> 
                                <div class="dark:text-light text-base font-sans">
                                    <div x-bind:class="`markdown font-sans leading-[25px] ${ msg.author === 'ChatGPT' && 'text-[#4a4242] dark:text-[#d3d3d3]' }`" x-html="msg.html"></div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <x-modal name="update-conversation" :show="false">
                    <x-form-box :title="'Edit conversation'" class="mx-0">
                        <p class="font-sans dark:text-light text-[15px] mt-[36px]">Add a category to:</p>
                        <p class="font-special dark:text-light text-xl lg:text-2xl" x-text="post.title"></p>
                        @include('partials/update-conversation')
                    </x-form-box>
                </x-modal>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    

    document.addEventListener('alpine:init', () => {

        Alpine.data('conversation', () => ({
            post: {},

            async init() {
                this.$store.api.setQueryId()
                await this.$store.api.setConversation()
                this.post = this.$store.api.conversation
                this.$dispatch('update-cat-select')
                this.$store.api.loading = false
            }
        }))
    })

</script>