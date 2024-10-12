<x-wrappers.form :title="'Load conversations.json'" :class="'2xl:min-w-[600px]'">

    <form x-data="loadConversationsForm" @submit.prevent="processJson" class="mt-[56px] mb-[67px] lg:mx-[30px]">
        @csrf
        @method('post')

        <x-wrappers.form-field>
            <x-input.text id="json" name="json" type="file" class="border-none text-dark" @change="handleFileUpload" />
        </x-wrappers.form-field>

        <div class="mt-4">
            <x-buttons.primary x-bind:class="`flex items-center ${ !ok && 'bg-white text-dark opacity-30 pointer-events-none' }`">
                <span x-show="loadingJson">
                    <x-ui.spinner />
                </span>
                <span x-text="loadingJson ? 'Saving' : 'Save' ">
                </span>
            </x-buttons.primary>
        </div>

        <div class="mt-12">
            <p x-show="ok" x-html="okMessage" class="text-green font-bold"></p>
            <p x-show="error" x-html="errorMessage" class="text-magenta font-bold"></p>
        </div>

    </form>
</x-wrappers.form>