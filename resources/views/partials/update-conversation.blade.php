<div 
    class="w-full h-fit pr-6" 
    x-data="{ showCreateForm: false }" 
    @toggle-create-form.window="showCreateForm = $event.detail" 
>
    <div class="my-[45px]" x-show="$store.api.categoryList.length > 0" >
        <x-forms.add-category /> 
    </div>
    <div x-show="showCreateForm" class="my-[45px]">
        <p class="dark:text-light font-sans font-light text-base mt-5 flex items-center">
            <span>Create a category</span>
            <span 
                x-show="$store.api.categoryList.length > 0" 
                @click="showCreateForm = false" 
                class="ml-[15px] inline-block w-[12px] h-[12px] bg-contain bg-no-repeat cursor-pointer transform hover:scale-[1.1]" 
                style="background-image: url({{ asset('icons/close-icon.svg') }})"
            >
            </span>
        </p>
        <x-forms.create-category />
    </div>
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

    // Alpine.data('addCategoryForm', () => ())

})

</script>