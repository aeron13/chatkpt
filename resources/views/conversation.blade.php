<x-app-layout>
    <div class="mx-[15px] lg:mx-[35px] grid grid-cols-12 pt-[170px] lg:pt-0">
        <div class="lg:pt-[162px]">
            @include('partials/sidebar')
        </div>
        <div x-ref="container" class="conversation-container overflow-y-scroll col-span-12 lg:col-start-4 grid grid-cols-8 pb-[100px] lg:pt-[162px] lg:h-screen" x-data="conversation" >
            <div class="col-span-12 lg:col-span-7">
                <div class="mx-2 mb-[90px] lg:mb-[50px] transform lg:translate-y-[-10px]">
                    <div class="flex flex-col-reverse lg:flex-row lg:justify-between items-baseline">
                        <h1 class="font-special text-[32px] leading-tight lg:text-[40px] text-light" x-text="post.title"></h1>
                        <p x-text="post.create_time" class="font-sans text-light text-sm mb-3 text-right"></p>
                    </div>
                    <template x-if="post.categories">
                        <div class="lg:hidden font-sans text-light text-base mt-4 lg:mt-2">
                            <p>In: 
                                <template x-for="(cat, index) in post.categories">
                                    <span class="font-special font-bold">
                                        <span x-text="cat.name"></span>
                                        <span x-show="post.categories.length > 1 && index != post.categories.length -1">,</span> 
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
                            <div x-bind:class="`relative z-1 p-[20px] lg:pt-[24px] lg:px-[30px] lg:pb-[37px] rounded-[16px] mb-[21px] max-w-[960px] backdrop-blur-[28.73px] ${ msg.author === 'user' && 'border border-[#868686] border-[0.5px] bg-glass-1' }`">
                                <div class="font-sans flex items-center mb-1 lg:mb-6">
                                    <span class="inline-block w-[20px] h-[20px] lg:w-[26px] lg:h-[26px] rounded-full mr-2 lg:mr-3"  x-bind:style="`background-color: ${ post.categories && msg.author === 'user' ? post.categories[0].color : '#E5E8DB' }`"></span>
                                    <p class="text-light text-lg font-bold" x-text="msg.author === 'user' ? 'You' : msg.author"></p>   
                                </div> 
                                <div class="text-light text-base font-sans">
                                    <div x-bind:class="`markdown font-sans leading-[25px] ${ msg.author === 'ChatGPT' && 'text-[#d3d3d3]' }`" x-html="msg.html"></div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div id="scrollbar" x-ref="scrollbar" class="hidden lg:block fixed w-[4px] rounded bg-[#252525] right-[35px]" style="height: calc(100vh - 170px)">
                <div x-ref="indicator" class="scroll-indicator h-[60px] w-full bg-[#A9A9A9] rounded absolute"></div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    

    document.addEventListener('alpine:init', () => {

        Alpine.data('conversation', () => ({
            post: {},

            async init() {

                this.$store.api.setQueryId()
                this.post = await this.$store.api.getConversation()
                this.$store.api.loading = false

                const container = this.$refs.container;
                const indicator = this.$refs.indicator;
                
                container.addEventListener('scroll', () => {
                    const scrollY = container.scrollTop
                    const top = container.scrollTop / (container.scrollHeight - container.clientHeight) * (this.$refs.scrollbar.clientHeight - indicator.clientHeight);
                    indicator.style.top = top + 'px'
                })
            }
        }))
    })

    // window.addEventListener('load', () => {

    // })

</script>