<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ChatKPT</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Kodchasan:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="icon" type="image/x-icon" href="/favicon-2.ico">
    </head>
    <body class="bg-light-gradient dark:bg-none dark:bg-dark">
            <x-header>
                <div class="lg:hidden">
                    <x-ui.dropdown :align="'right'" width="140">
                        <x-slot name="trigger">
                            <div class="dark:text-light">Start</div>
                            <x-ui.toggle-arrow />
                        </x-slot>

                        <x-slot name="content">
                            <x-ui.dropdown-link :href="route('login')">
                                {{ __('Log in') }}
                            </x-ui.dropdown-link>
                            <x-ui.dropdown-link :href="route('register')">
                                {{ __('Register') }}
                            </x-ui.dropdown-link>

                        </x-slot>
                    </x-ui.dropdown>
                </div>
                <nav class="hidden lg:block font-light dark:text-light text-xl font-sans h-full items-center">
                    <a href="{{ route('login') }}" class="mr-6">Log in</a>
                    <a href="{{ route('register') }}" class="">Register</a>
                </nav>
            </x-header>
            <main class="bg-welcome min-h-screen w-full bg-no-repeat">
                {{ $slot }}
            </main>
            <x-ui.toggle-dark-mode />
    </body>
</html>
