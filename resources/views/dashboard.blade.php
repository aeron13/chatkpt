<x-app-layout>
    <div x-data="dashboardPage">
        <div class="mx-[20px] lg:mx-[35px] grid lg:grid-cols-12 pt-[162px]">
            @include('partials/sidebar')
            <div x-show="$store.api.loading" class="w-full lg:col-start-4 lg:col-end-12  flex justify-center lg:justify-start">
                <x-ui.spinner />
            </div>
            <div x-show="!empty && !$store.api.loading" class="lg:col-start-4 lg:col-end-12 pb-[100px]" >
                <div class="lg:flex items-center gap-5 justify-between mb-12 lg:mb-14">
                    <h6 class="font-sans font-medium text-2xl lg:text-[32px] dark:text-light mb-3">All conversations</h6>
                    <x-forms.search />
                </div>
                @include('partials/conversations-list')
            </div>
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
                                <button class="px-10 pt-[15px] pb-[17px] rounded-[30px] shadow border-2 dark:border-white dark:border-opacity-50 dark:text-white text-xl font-bold font-sans leading-tight">Load conversations</button>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>