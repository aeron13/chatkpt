<div 
    x-bind:class="`flex gap-6 rounded-[4px] px-2 transition ${ showMenu && 'bg-white' } `" 
    x-data="{ showMenu: false }" 
    @close-oneline-menu.window="showMenu = false" 
    @click.outside="showMenu = false"
>
    <ul class="flex gap-3" x-show="showMenu" x-transition.opacity>
        {{ $slot }}
    </ul>
    <button @click="showMenu = !showMenu">
        <div class="flex flex-col frex-wrap" x-show="!showMenu">
            <span class="w-[17px] h-[1px] bg-light rounded" ></span>
            <span class="w-[17px] h-[1px] bg-light rounded mt-1" ></span>
            <span class="w-[17px] h-[1px] bg-light rounded mt-1" ></span>
        </div>
        <div class="w-[15px] h-[15px] relative" x-show="showMenu" style="background-image: url({{ asset('icons/remove-icon.svg') }})"></div>
    </button>
</div>