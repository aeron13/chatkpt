<template>
    <header class="fixed w-full">
        <div class="relative mt-[26px] mx-[35px] rounded-[10px] border-[#767676] border-[0.5px] shadow-glass-2">
            <!-- <div class="bg-dark h-[78px] absolute z-0 top-[1px] left-[1px] rounded-[9px]" style="width: calc(100% - 2px)"></div> -->
            <div class="relative flex justify-between items-center rounded-[10px] px-[26px] pt-[18px] pb-[21px] bg-glass-2 backdrop-blur-md z-1">
                <a href="/">
                    <h5 class="font-special text-light text-[26px]">ChatKPT</h5>
                </a>
                <nav class="flex font-light text-light text-xl font-sans h-full items-center">
                    <a href="{{ route('login') }}" class="mr-6">Log in</a>
                    <a href="{{ route('register') }}" class="">Register</a>
                </nav>
            </div>
        </div>
    </header>
    <main class="min-h-screen w-full bg-contain bg-no-repeat" style="background-image: url({{ asset('img/bg-welcome.svg') }})">
    </main>
</template>