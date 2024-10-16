<div class="relative w-full" x-data="{ showDropdown: false }">
    <div 
        @click="showDropdown = !showDropdown" 
        x-bind="selectedCategories" 
        class="h-[54px] flex items-center gap-1 w-full font-bold px-[5px] py-[7px] bg-white rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px] cursor-pointer overflow-x-scroll"
    >
        <p 
            x-show="selectedCategories.length < 1" 
            x-bind:class="`ml-3 text-lg py-1.5 ${ showDropdown && 'opacity-10' }`"
        >
            Select category
        </p>
        <template x-show="selectedCategories.length > 0" x-for="cat in selectCategories.filter(obj => !obj.parent_id)">
            <div class="flex gap-1">
                <template x-if="cat.selected">
                    <x-ui.tag name="cat.name" color="cat.color" removeAction="$dispatch('toggle-category', [cat.id])" /> 
                </template>
                <template x-if="cat.children">
                    <template x-for="child in cat.children">
                        <template x-if="child.selected">
                            <x-ui.tag name="child.name" color="child.color" removeAction="$dispatch('toggle-category', [cat.id, child.id])" /> 
                        </template>
                    </template>
                </template>
            </div>
        </template>
    </div>
    <div 
        x-show="showDropdown" 
        class="absolute mt-[5px] z-10 w-[215px] max-h-[253px] p-[9px] pb-[2px] bg-white rounded-[10px] shadow overflow-y-scroll" 
        @click.outside="showDropdown = false"
    >
        <ul>
            <template x-for="cat in selectCategories.filter(obj => !obj.parent_id )" x-bind:key="cat.id">
                <li class="mb-2 w-full">
                    <div 
                        @click="$dispatch('toggle-category', [cat.id])" 
                        class="w-full px-[11px] pt-1 pb-[6px] flex justify-between items-center cursor-pointer"
                    >
                        <p x-text="cat.name" class="text-black text-lg font-bold font-special"></p>
                        <span 
                            class="block w-[12px] h-[12px] rotate-[-4.45deg] rounded-sm" 
                            x-bind:class="!cat.selected && 'hidden' " 
                            x-bind:style="`background-color: ${cat.color}`"
                        ></span>
                    </div>
                    <ul class="w-full">
                    <template x-for="child in cat.children" x-bind:key="child.id">
                            <li class="pl-[16px] pr-[11px] pt-1 pb-[6px]">
                                <div @click="$dispatch('toggle-category', [cat.id, child.id])" class="w-full flex justify-between items-center cursor-pointer" >
                                    <p x-text="child.name" class="text-black text-base font-special"></p>
                                    <span 
                                        class="block w-[8px] h-[8px] rotate-[-4.45deg] rounded-sm" 
                                        x-bind:class="!child.selected && 'hidden' " 
                                        x-bind:style="`background-color: ${cat.color}`"
                                    ></span>
                                </div>
                            </li>
                    </template>
                    </ul>
                </li>
            </template>
        </ul>
    </div>
</div>