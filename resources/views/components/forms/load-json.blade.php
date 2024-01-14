<x-form-box :title="'Load conversations.json'" :class="'2xl:min-w-[600px]'">

    <form x-data="form" @submit.prevent="processJson" class="mt-[56px] mb-[67px] lg:mx-[30px]">
        @csrf
        @method('post')

        <x-form-block>
            <x-text-input id="json" name="json" type="file" class="border-none text-dark" @change="handleFileUpload" />
        </x-form-block>

        <div class="mt-4">
            <x-primary-button x-bind:class="`flex items-center ${ !ok && 'bg-white text-dark opacity-30 pointer-events-none' }`">
                <span x-show="loadingJson">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                <span x-text="loadingJson ? 'Saving' : 'Save' ">
                </span>
            </x-primary-button>
        </div>

        <div class="mt-12">
            <p x-show="ok" x-html="okMessage" class="text-green font-bold"></p>
            <p x-show="error" x-html="errorMessage" class="text-magenta font-bold"></p>
        </div>

    </form>
</x-form-box>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('form', () => ({
            uploadedFile: {},
            data: {},
            loadingJson: false,
            error: false,
            errorMessage: '',
            ok: null,
            okMessage: '',

            handleFileUpload() {
                const file = this.$event.target.files[0];
                if (file) {
                    if (file.name != 'conversations.json') {
                        this.error = true
                        this.errorMessage = 'Incorrect file name.'
                        return
                    }
                    const reader = new FileReader();
                    reader.onload = () => {
                        try {
                            const jsonData = JSON.parse(reader.result);
                            this.data = reader.result
                            this.ok = true
                            this.okMessage = 'The file is valid';

                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                            // Handle invalid JSON error
                            this.error = true
                            this.errorMessage = 'Invalid json file.'
                        }
                    };
                    reader.readAsText(file);
                    this.uploadedFile = file;
                    this.error = false
                }
            },
 
            async processJson() {
                this.$event.preventDefault()

                if (this.ok && !this.loadingJson) {

                    this.loadingJson = true

                    await fetch('api/conversations', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.$store.csrf.token,
                        },
                        body: JSON.stringify({
                            'conversations': this.data,
                        }),
                    })
                    .then((response) => response.json())
                    .then(() => {
                        window.location.href = 'dashboard'
                    })
                    .catch((error) => {
                        console.log(error)
                        this.error = true
                        this.ok = false
                        this.errorMessage = 'An error occured'
                    });

                }
            }
        }))
    })
</script>