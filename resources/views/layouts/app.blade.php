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

        <link rel="icon" type="image/x-icon" href="/favicon.ico">

    </head>
    <body class="bg-light-gradient dark:bg-none dark:bg-dark relative">
        @include('layouts.navigation')
    
        <main class="w-full min-h-screen">
            {{ $slot }}
        </main>
        <footer class="absolute w-full dark:text-light font-sans text-[12px] opacity-70 px-[20px] lg:px-[35px] pb-5 bottom-0">
            <p>ChatKPT</p>
            <p>Coded by: 
                <a href="https://margheritamagatti.it" target="_blank">M. M.</a>
            </p>
        </footer>
        <!-- <x-toggle-dark-mode /> -->
    </body>
</html>
