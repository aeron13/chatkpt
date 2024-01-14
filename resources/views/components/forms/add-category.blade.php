

<form x-data="addCategoryForm" @submit.prevent="handleSubmit" x-bind:conv="id" @update-id.window="updateId($event.detail)" @update-data.window="updateData()" @reset-data.window="resetData()" @toggle-category.window="toggleCategory($event.detail)">

    <x-form-block x-bind:class="`mt-4 flex gap-3 items-center ${ showCreateForm && 'pointer-events-none opacity-20' }`">
        <select id="category" name="category" multiple x-model="selectedCategories" class="hidden w-full text-lg font-bold px-[16px] py-[12px] focus:outline-none rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px] placeholder:font-light">
            <template x-for="cat in $store.api.categoryList" :key="cat.id">
                <option x-model="cat.id" x-text="cat.name"></option>
            </template>
        </select>
        <x-multiselect-input />
    </x-form-block>

    <div x-show="!showCreateForm" class="dark:text-light opacity-90 mt-[22px] mb-[45px]">
        <p class="text-[15px]">Or:</p>
        <p class="font-semibold border-b dark:border-light mt-[5px] cursor-pointer w-fit" @click="showCreateForm = true">Create new category</p>
    </div>

    <div x-bind:class="`mt-4 ${ showCreateForm && 'hidden'  }`">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>

</form>