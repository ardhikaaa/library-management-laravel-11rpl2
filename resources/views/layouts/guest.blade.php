<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- icon --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    </head>
    <body class="font-sans text-gray-900 antialiased overflow-auto md:overflow-hidden">
        
        <nav class="bg-white border-gray-200 p-4 text-black drop-shadow-lg">
            <div class="flex flex-wrap justify-end items-center mx-auto max-w-screen-xl gap-6">
                <p>{{ now()->format('l, d m y | H:i') }}</p>
                <i class="fa-regular fa-calendar"></i>
            </div>
        </nav>

        <div class="min-h-screen flex flex-col md:flex-row  sm:justify-center items-center gap-10 pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <img src="login.png" alt="" class="h-[25rem] w-[25rem]">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[#FFC000] shadow-md overflow-hidden sm:rounded-lg">
                <h1 class="text-white text-2xl pb-5"><span class=" font-semibold"> Selamat Datang di Perpustakaan </span> SMK Pesat ITXPRO</h1>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
