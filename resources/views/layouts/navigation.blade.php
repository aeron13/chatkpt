<header class="fixed w-full z-[9]">
    <div class="relative mt-[12px] lg:mt-[26px] mx-[14px] lg:mx-[35px] rounded-[10px] border-[#C9C9C9] dark:border-[#767676] border-[0.5px] shadow-strong dark:shadow dark:lg:shadow-glass-2">
        <div class="relative grid grid-cols-2 lg:grid-cols-12 rounded-[10px] bg-lightglass-2 dark:bg-glass-2 backdrop-blur-md z-1">
            <div class="lg:col-span-3 px-[17px] py-[13px] lg:px-[26px] lg:pt-[18px] lg:pb-[21px]">
                <x-application-logo/>
            </div>
            <nav class="lg:hidden dashboard-nav flex items-center justify-end">
                <x-dropdown :align="'center'">
                    <x-slot name="trigger">
                        <div class="dark:text-light">Menu</div>
                        <x-toggle-arrow />
                    </x-slot>

                    <x-slot name="content">
                        <div class="mb-12" x-show="$store.api.categoryList.length > 0">
                            <h3 class="mb-4 text-sm">Categories</h3>
                            @include('partials/categories-list')
                        </div>

                        <div class="">
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('load')">
                                {{ __('Load') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

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
                    </x-slot>
                </x-dropdown>
            </nav>
            <nav class="hidden lg:flex col-span-9 justify-between font-light dark:text-light text-[16px] font-sans h-full items-center pr-[26px]">
                <div class="flex">
                    <a href="{{ route('dashboard') }}" class="mr-16">Dashboard</a>
                    <a href="{{ route('load') }}">Load</a>
                </div>
                <!-- Settings Dropdown -->
                <div class="flex ms-6 items-center">
                    <div class="flex items-center">
                        <x-dropdown :align="'right'" width="192">
                            <x-slot name="trigger">
                                    <span class="w-[13px] h-[13px] rounded-full bg-dark dark:bg-[#E5E8DB] mr-2" ></span>
                                    <div>{{ Auth::user()->name }}</div>
                                    <x-toggle-arrow />
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>



