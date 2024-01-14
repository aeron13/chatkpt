<x-app-layout>
    <div x-data="dashboard">
        <div class="mx-[20px] lg:mx-[35px] grid lg:grid-cols-12 pt-[162px]">
            @include('partials/sidebar')
            @include('partials/conversations-list')
            <template x-if="empty && !$store.api.loading">
                <div class="col-start-1 col-end-12 dark:text-light mx-[10px] flex justify-center">
                    <div class="w-fit lg:pt-[30px]">
                        <p class="mb-20 lg:mb-8 text-center">Welcome!</p>
                        <p class="text-xl mb-4">How to get going</p>
                        <ol class="list-decimal ml-[20px] mb-8">
                            <li>Go to ChatGPT and export your data. They will be sent to your e-mail.</li>
                            <li>Save the zip folder you received</li>
                            <li>Open the zip folder and find the file named 'conversations.json'</li>
                        </ol>
                        <div class="w-full  flex justify-center lg:justify-start">
                            <a href="/load">
                                <button class="px-10 pt-[15px] pb-[17px] rounded-[30px] shadow border-2 border-white border-opacity-50 text-white text-xl font-bold font-sans leading-tight">Load conversations</button>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">

    document.addEventListener('alpine:init', () => {

        Alpine.data('dashboard', () => ({
            empty: true,

            async init() {
                await this.$store.api.setConversations()
                this.$store.api.loading = false
                if (this.$store.api.conversations.length > 0) this.empty = false
                console.log(this.empty)
            }
        }))

    })
</script>