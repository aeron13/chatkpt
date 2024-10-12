<div class="relative w-fit h-fit">
    <div class="absolute w-full h-full z-0 opacity-30 rounded-[7px]" x-bind:style="`background-color: ${ {{ $color }} }`"></div>
    <div class="pl-2 pr-[5px] py-1.5 justify-start items-center gap-[5px] inline-flex">
        <p class="text-black font-bold font-special" x-text="{{ $name }}"></p>
        <div class="w-[15px] h-[15px] relative" @click="{{ $removeAction }}" style="background-image: url({{ asset('icons/remove-icon.svg') }})"></div>
    </div>
</div>