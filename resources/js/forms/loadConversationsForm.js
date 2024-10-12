export const loadConversationsForm = () => ({
    
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
})