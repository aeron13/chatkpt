<div class="relative w-full" x-data="multiselect">
    <div @click="showDropdown = !showDropdown" class="flex gap-1 w-full text-lg font-bold px-[5px] py-[7px] bg-white rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px]">
        <template x-if="selectedCategories.length < 1">
            <p class="ml-3 py-1.5">Select category</p>
        </template>
        <template x-for="cat in selectCategories.filter(cat => cat.selected)">
            <div class="relative w-fit">
                <div class="absolute w-full h-full z-0 opacity-30 rounded-[7px]" x-bind:style="`background-color: ${cat.color}`"></div>
                <div class="pl-2 pr-[5px] py-1.5 justify-start items-center gap-[5px] inline-flex">
                    <p class="text-black font-bold font-special" x-text="cat.name"></p>
                    <div class="w-[15px] h-[15px] relative" @click="$dispatch('toggle-category', [cat.id])" style="background-image: url({{ asset('icons/remove-icon.svg') }})"></div>
                </div>
            </div>
        </template>
    </div>
    <div x-show="showDropdown" class="absolute mt-[5px] z-10 w-[215px] max-h-[253px] p-[9px] bg-white rounded-[10px] shadow">
        <ul>
            <template x-for="cat in selectCategories.filter(obj => !obj.parent_id )" x-bind:key="cat.id">
                <li class="mb-2 w-full">
                    <div @click="$dispatch('toggle-category', [cat.id])" class="w-full px-[11px] pt-1 pb-[6px] flex justify-between items-center cursor-pointer">
                        <p x-text="cat.name" class="text-black text-lg font-bold font-special"></p>
                        <span class="block w-[12px] h-[12px] rotate-[-4.45deg] rounded-sm" x-show="cat.selected" x-bind:style="`background-color: ${cat.color}`"></span>
                    </div>
                    <ul class="w-full">
                    <template x-for="child in cat.children" x-bind:key="child.id">
                            <li class="pl-[16px] pr-[11px] pt-1 pb-[6px]">
                                <div @click="$dispatch('toggle-category', [cat.id, child.id])" class="w-full flex justify-between items-center cursor-pointer" >
                                    <p x-text="child.name" class="text-black text-base font-special"></p>
                                    <span class="block w-[8px] h-[8px] rotate-[-4.45deg] rounded-sm" x-show="child.selected" x-bind:style="`background-color: ${cat.color}`"></span>
                                </div>
                            </li>
                    </template>
                    </ul>
                </li>
            </template>
        </ul>
    </div>
</div>

<script>

    document.addEventListener('alpine:init', () => {
        console.log('ini')
        
        Alpine.data('multiselect', () => ({
            showDropdown: false,


        }))
    })

</script>