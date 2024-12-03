<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Library Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- icon --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>

<body class="font-sans antialiased dark:text-white/50 overflow-auto lg:overflow-hidden">

<nav class="bg-white border-gray-200 p-4 text-black drop-shadow-lg">
    <div class="flex flex-wrap justify-end items-center mx-auto max-w-screen-xl gap-6">
        <p>{{ now()->format('l, d m y | H:i') }}</p>
        <i class="fa-regular fa-calendar"></i>
    </div>
</nav>


<section class="bg-white flex justify-center items-center py-7">
    <div class="flex flex-col justify-center items-center">
        <div class="">
            <img src="dashboard.png" alt="" class="lg:h-[20rem]  md:h-[18rem] sm:h-[16rem]">
        </div>
        <div class="text-black text-center md:px-6 sm:px-5">
            <h3 class="text-2xl font-semibold">Selamat Datang di e-Perpustakaan SMK Pesat ITXPRO</h3>
            <p>Platform digital untuk kemudahan akses koleksi dan layanan perpustakaan SMK Pesat ITXPRO.</p>
        </div>
        <div class=" py-5">
                @if (Route::has('login'))
                    <nav class="flex flex-1 justify-start gap-4">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black bg-slate-500 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black bg-slate-500/80 hover:bg-slate-700/80 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"                            >
                                Log in
                            </a>
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
        
    </section>
</body>


</html>

