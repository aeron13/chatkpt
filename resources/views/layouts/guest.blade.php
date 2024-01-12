<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Kodchasan:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-dark">
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
                {{ $slot }}
            </main>
    </body>
</html>
