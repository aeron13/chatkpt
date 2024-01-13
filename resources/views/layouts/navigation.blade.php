<x-header>
    <nav class="lg:hidden dashboard-nav">
        <x-dropdown :align="'center'">
            <x-slot name="trigger">
                    <div class="text-light">Menu</div>
            </x-slot>

            <x-slot name="content">
                <div class="mb-12" x-show="$store.api.categoryList.length > 0">
                    <h3 class="mb-4">Categories</h3>
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
    <nav class="hidden lg:flex font-light text-light text-[16px] font-sans h-full items-center">
        <a href="{{ route('dashboard') }}" class="mr-10">Dashboard</a>
        <a href="{{ route('load') }}" class="mr-4">Load</a>
        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown :align="'right'" width="192">
                <x-slot name="trigger">
                        <div>{{ Auth::user()->name }}</div>
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
    </nav>
</x-header>


