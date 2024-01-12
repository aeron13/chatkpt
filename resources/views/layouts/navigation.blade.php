<header class="fixed w-full z-[9]">
    <div class="relative mt-[26px] mx-[35px] rounded-[10px] border-[#767676] border-[0.5px] shadow-glass-2">
        <!-- <div class="bg-dark h-[78px] absolute z-0 top-[1px] left-[1px] rounded-[9px]" style="width: calc(100% - 2px)"></div> -->
        <div class="relative flex justify-between items-center rounded-[10px] px-[26px] pt-[18px] pb-[21px] bg-glass-2 backdrop-blur-md z-1">
            <a href="{{ route('dashboard') }}">
                <h5 {{ $attributes }} class="font-special text-light text-[26px]">ChatKPT</h5>
            </a>
            <nav class="flex font-light text-light text-[16px] font-sans h-full items-center">
                <a href="{{ route('dashboard') }}" class="mr-10">Dashboard</a>  
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">


                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
                </div>              
            </nav>
        
        </div>
    </div>
</header>


