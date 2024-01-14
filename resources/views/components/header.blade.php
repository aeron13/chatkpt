<header class="fixed w-full z-[9]">
    <div class="relative mt-[12px] lg:mt-[26px] mx-[14px] lg:mx-[35px] rounded-[10px] border-[#C9C9C9] dark:border-[#767676] border-[0.5px] shadow-lightglass-2 dark:shadow dark:lg:shadow-glass-2">
        <div class="relative flex justify-between items-center rounded-[10px] px-[17px] py-[13px] lg:px-[26px] lg:pt-[18px] lg:pb-[21px] bg-lightglass-2 dark:bg-glass-2 backdrop-blur-md z-1">
            <x-application-logo/>
            {{ $slot }}
        </div>
    </div>
</header>