<ul class="categories-list" x-data="sidebar">
    <template x-for="cat in $store.api.categoryOrderedList" x-bind:key="cat.id">
        <li class="mb-[26px]">
            <a x-bind:href="`/category/${cat.id}`" class="flex items-center">
                <span class="block w-[17px] h-[17px] rotate-[-4.45deg] rounded-sm" x-bind:style="`background-color: ${cat.color}`"></span>
                <p x-text="cat.name" class="text-white text-[21px] font-semibold font-special ml-[9px]"></p>
            </a>
            <ul>
            <template x-for="child in cat.children" x-bind:key="child.id">
                <a x-bind:href="`/category/${child.id}`">
                    <li class="ml-[10px] mt-[8px] flex items-center">
                        <span class="block w-[8px] h-[8px] rotate-[-4.45deg] rounded-sm" x-bind:style="`background-color: ${child.color}`"></span>
                        <p x-text="child.name" class="text-white text-base font-special ml-[9px]"></p>
                    </li>
                </a>
            </template>
            </ul>
        </li>
    </template>
</ul>

<script type="text/javascript">

    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebar', () => ({
            async init() {
                await this.$store.api.setCategories()
            }
        }))
    })

</script>