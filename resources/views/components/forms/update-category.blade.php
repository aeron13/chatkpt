<div 
    x-data="updateCategoryForm" 
    class="modal fixed top-0 left-0 w-full h-full z-10 bg-black bg-opacity-70 flex justify-center pt-[130px] lg:pt-[173px]" 
    x-show="showUpdateForm" 
    @toggle-update-form.window="showUpdateForm = !showUpdateForm"
    style="display: none" 
    x-transition
>
    <div class="w-full lg:w-fit h-fit lg:mt-20">
        <button class="block w-[17px] h-[17px] bg-contain bg-no-repeat ml-auto mb-3 mr-[20px] lg:mr-3 transform hover:scale-[1.1] transition-transform" @click="showUpdateForm = false" style="background-image: url({{ asset('icons/close-icon.svg') }})"></button>
        <x-wrappers.form title="Update category" class="mx-0">
            <form class="my-[45px]" @submit.prevent="handleSubmit">
                <div class="grid grid-cols-2 lg:grid-cols-5 gap-3">
                    <div class="col-span-2 lg:col-span-3 mt-4 lg:mt-[23px]">
                        <x-wrappers.form-field>
                            <x-input.label for="name" :value="__('Name')" /> 
                            <x-input.text id="name" name="name" x-model="category.name" type="text" placeholder="Name" class="px-[14px] py-[8px] text-sm"  />
                        </x-wrappers.form-field>   
                    </div> 
                    <x-wrappers.form-field class="flex flex-col gap-1">
                        <label for="color" class="font-bold text-sm dark:text-light">Color</label>
                        <select id="color" x-model="category.color" name="color" class="w-full text-lg font-sm px-[8px] py-[8px] text-sm focus:outline-none rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px] placeholder:font-light">
                            <template x-for="colorEl in colors">
                                <option x-bind:value="colorEl.hex" x-text="colorEl.hue"></option>
                            </template>
                        </select>
                    </x-wrappers.form-field>
                    <x-wrappers.form-field class="flex flex-col gap-1" x-show="$store.api.categoryList.length > 0">
                        <label for="parent_id" class="font-bold text-sm dark:text-light">Parent</label>
                        <select id="parent_id" x-model="category.parent_id" name="parent_id" class="w-full text-lg font-sm px-[8px] py-[8px] text-sm focus:outline-none rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px] placeholder:font-light">
                            <option value="">Select</option>
                            <template x-for="cat in $store.api.categoryList.filter(x => !x.parent_id)">
                                <option x-model="cat.id" x-text="cat.name"></option>
                            </template>
                        </select>
                    </x-wrappers.form-field>
                </div>
                <div x-show="error" class="mt-4">
                    <p x-html="error" class="text-magenta font-bold"></p>
                </div>
                <div class="mt-6 lg:mt-4">
                    <x-buttons.primary>
                        <span x-show="sending">
                            <x-ui.spinner />
                        </span>
                        <span x-text="sending ? 'Saving' : 'Update' ">
                        </span>
                    </x-buttons.primary>
                </div>
            </form>
        </x-wrappers.form>
    </div>
    
</div>