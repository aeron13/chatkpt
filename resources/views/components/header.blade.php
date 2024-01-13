<header class="fixed w-full z-[9]">
    <div class="relative mt-[12px] lg:mt-[26px] mx-[14px] lg:mx-[35px] rounded-[10px] border-[#767676] border-[0.5px] shadow lg:shadow-glass-2">
        <!-- <div class="bg-dark h-[78px] absolute z-0 top-[1px] left-[1px] rounded-[9px]" style="width: calc(100% - 2px)"></div> -->
        <div class="relative flex justify-between items-center rounded-[10px] px-[17px] py-[13px] lg:px-[26px] lg:pt-[18px] lg:pb-[21px] bg-glass-2 backdrop-blur-md z-1">
            <x-application-logo/>
            {{ $slot }}
        </div>
    </div>
</header>