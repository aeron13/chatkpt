<div class="w-full lg:w-fit h-fit" x-data="{ showCreateForm: false }" @toggle-create-form.window="showCreateForm = $event.detail" >
    <button class="block w-[17px] h-[17px] bg-contain bg-no-repeat ml-auto mb-3 mr-[20px] lg:mr-3 transform hover:scale-[1.1] transition-transform" @click="closeModal" style="background-image: url({{ asset('icons/close-icon.svg') }})"></button>
    <x-form-box :title="'Add category'" class="mx-0">
        <p class="font-sans dark:text-light text-[15px] mt-[36px]">Add a category to:</p>
        <p class="font-special dark:text-light text-xl lg:text-2xl" x-text="title"></p>
        <div class="my-[45px]" x-show="$store.api.categoryList.length > 0" >
            <x-forms.add-category /> 
        </div>
        <div x-show="showCreateForm" class="my-[45px]">
            <p class="dark:text-light font-sans font-light text-base mt-5 flex items-center">
                <span>Create a category</span>
                <span x-show="$store.api.categoryList.length > 0" @click="showCreateForm = false" class="ml-[15px] inline-block w-[12px] h-[12px] bg-contain bg-no-repeat cursor-pointer transform hover:scale-[1.1]" style="background-image: url({{ asset('icons/close-icon.svg') }})"></span>
            </p>
            <x-forms.create-category />
        </div>
    </x-form-box>
</div>

<script type="text/javascript">

class Category {
    constructor(data, children, selected) {
        this.id = data.id
        this.name = data.name
        this.color = data.color
        this.parent_id = data.parent_id
        this.children = children
        this.selected = selected
    }
}

document.addEventListener('alpine:init', () => {

    Alpine.data('multiselect', () => ({
        showDropdown: false,
    }))

    Alpine.data('addCategoryForm', () => ({
        selectCategories: [],
        selectedCategories: [],
        conversation_id: null,
        error: '',

        updateId(conv_id) {
            this.conversation_id = conv_id;
            this.updateData()
        },

        updateData() {

            const conversation = this.$store.api.conversations.find(conv => conv.id == this.conversation_id );

            if (conversation.categories) {
                this.selectedCategories = conversation.categories.map(cat => cat.id)
            }

            this.selectCategories = this.$store.api.categoryOrderedList.map(storeCat => {

                let children = storeCat.children.map(obj => {
                    return new Category(obj, null, this.selectedCategories.find(x => x == obj.id))
                })

                return new Category(storeCat, children, this.selectedCategories.find(x => x == storeCat.id))
            })
        },

        resetData() {
            this.selectCategories = []
            this.selectedCategories = []
            this.conversation_id = null
        },

        toggleCategory(ids) {

            const category = this.selectCategories.find(x => x.id == ids[0])
            const idIndex = this.selectedCategories.findIndex(x => x == ids[0])

            if (ids.length > 1) {

                const child = category.children.find(x => x.id == ids[1])
                child.selected = !child.selected;

                if (child.selected) {

                    this.selectedCategories.push(ids[1])

                    if (idIndex == -1) {
                        category.selected = true;
                        this.selectedCategories.push(ids[0])
                    }

                } else {
                    this.selectedCategories.splice(this.selectedCategories.findIndex(x => x == ids[1]), 1)
                }

            } else {
                category.selected = !category.selected;
                if (idIndex != -1 ) this.selectedCategories.splice(idIndex, 1)
                else this.selectedCategories.push(ids[0])
            }
        },

        isValid() {
            // if ( this.selectedCategories.length < 1 ) return false
            return true
        },

        async handleSubmit(event) {

            event.preventDefault()

            if (this.isValid()) {

                await fetch('/api/conversations/' + this.conversation_id, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.$store.csrf.token,
                    },
                    body: JSON.stringify({'categories': this.selectedCategories}),
                })
                .then((response) => response.json())
                .then(data => {
                    if (data.errors) {
                        this.error = data.message
                    } else {
                        this.handlePositiveSubmit()
                    }
                })
                .catch((error) => {
                    console.log(error)
                });

            } else {
                this.error = 'Some fields are missing. Check and try again'
            }
            
        },

        async handlePositiveSubmit() {
            await this.$store.api.setConversations()
            this.$dispatch('close-modal')
        }

    }))

})

</script>