<x-app-layout>
    <div class="mx-[35px] grid grid-cols-12 pt-[162px]">
        @include('partials/sidebar')
        <div class="col-start-4 col-end-12 pb-[100px]" x-data="conversation" >
            <h1 class="font-special text-[40px] text-light mb-[29px]" x-text="post.title"></h1>

            <div class="flex flex-col">
                <template x-for="(msg, index) in post.messages" :key="">
                    <div>
                        <template x-if="index == 0">
                            <div class="z-0 fixed w-[66px] h-[66px] rotate-[-4.45deg] rounded-[9px] transform translate-x-[-15px] translate-y-[-12px]" x-bind:style="`background-color: ${post.categories[0].color}`"></div>
                        </template>
                        <div x-bind:class="`relative z-1 pt-[24px] px-[30px] pb-[37px] rounded-[16px] mb-[21px] max-w-[960px] backdrop-blur-[28.73px] ${ msg.author === 'user' && 'border border-[#868686] border-[0.5px] bg-glass-1' }`">
                            <div class="font-sans flex mb-6">
                                <span class="inline-block w-[26px] h-[26px] bg-[#E5E8DB] rounded-full mr-3"></span>
                                <p class="text-light text-lg font-bold" x-text="msg.author === 'user' ? post.author : msg.author"></p>   
                            </div> 
                            <div class="text-light text-base font-sans">
                                <div x-bind:class="`markdown font-sans leading-[25px] ${ msg.author === 'ChatGPT' && 'text-[#d3d3d3]' }`" x-html="msg.html"></div>
                            </div>
                        </div>
                    </div>
                </template>
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

            }
        }))
    })
</script>