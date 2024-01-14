
<form method="POST" x-data="createCategoryForm" @submit.prevent="handleSubmit" class="">
    @csrf
    @method('post')

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3">
        <div class="col-span-2 lg:col-span-3 mt-4 lg:mt-[23px]">
            <x-form-block>
                <x-input-label for="name" :value="__('Name')" /> 
                <x-text-input id="name" name="name" x-model="category.name" type="text" placeholder="Name" class="px-[14px] py-[8px] text-sm"  />
            </x-form-block>   
        </div> 
        <x-form-block class="flex flex-col gap-1">
            <label for="color" class="font-bold text-sm text-light">Color</label>
            <select id="color" x-model="category.color" name="color" class="w-full text-lg font-sm px-[8px] py-[8px] text-sm focus:outline-none rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px] placeholder:font-light">
                <template x-for="colorEl in colors">
                    <option x-bind:value="colorEl.hex" x-text="colorEl.hue"></option>
                </template>
            </select>
        </x-form-block>
        <x-form-block class="flex flex-col gap-1">
            <label for="parent_id" class="font-bold text-sm text-light">Parent</label>
            <select id="parent_id" x-model="category.parent_id" name="parent_id" class="w-full text-lg font-sm px-[8px] py-[8px] text-sm focus:outline-none rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px] placeholder:font-light">
                <option value="">Select</option>
                <template x-for="cat in $store.api.categoryList">
                    <option x-model="cat.id" x-text="cat.name"></option>
                </template>
            </select>
        </x-form-block>
    </div>
    <div x-show="error" class="mt-4">
        <p x-html="error" class="text-magenta font-bold"></p>
    </div>
    <div class="mt-6 lg:mt-4">
        <x-primary-button>{{ __('Create') }}</x-primary-button>
    </div>

</form>

<script>
    document.addEventListener('alpine:init', () => {
        
        Alpine.data('createCategoryForm', () => ({
            colors: [
                {'hue': 'Green', 'hex': '#10D9A3'},
                {'hue': 'Magenta', 'hex': '#EF466F'},
                {'hue': 'Yellow', 'hex': '#FFC43D'},
                {'hue': 'Blue', 'hex': '#0F708B'},
                {'hue': 'Purple', 'hex': '#8797F5'},
            ],
            category: {
                name: null,
                color: null,
                parent_id: null,
            },
            error: '',

            init() {
                this.category.color = this.colors[0].hex
            },

            isValid() {
                if (!this.category.name || !this.category.color) return false
                return true
            },

            async handleSubmit(event) {

                this.$event.preventDefault()

                if (this.isValid()) {

                    await fetch('/api/categories', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.$store.csrf.token,
                        },
                        body: JSON.stringify(this.category),
                    })
                    .then((response) => response.json())
                    .then(data => {
                        console.log(data)
                        if (data.errors) {
                            this.error = data.message
                        } else {
                            this.handlePositiveSubmit(data.id)
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                    });

                } else {
                    this.error = 'Some fields are missing. Check and try again'
                }
            },

            async handlePositiveSubmit(category_id) {
                await this.$store.api.setCategories()
                
                this.$dispatch('update-data')
                if (this.category.parent_id) this.$dispatch('toggle-category', [this.category.parent_id, category_id])
                else this.$dispatch('toggle-category', [category_id])

                this.category.name = null
                this.category.parent_id = null
                this.showCreateForm = false
            }
            
        }))
    })
</script>