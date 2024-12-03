<?php
  use App\Models\Book;
  use App\Models\pinjambuku;

  $book_count = count(Book::all());

  $borrow_count = pinjambuku::where('status', 'borrowed')->count();
  $return_count = pinjambuku::where('status', 'available')->count();

  $broken_book = floor(rand(0, $book_count)*0.25)
?>

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}

    <section class="bg-white dark:bg-gray-900 dark:text-white sm:pl-64 md:pl-64 min-h-screen">

        <div class="p-8">
            <div class="py-10 px-20 bg-slate-50 dark:bg-gray-900 flex flex-row gap-20 items-center rounded-xl border-2 border-gray-500 dark:border-white">
                <img src="dashboard.png" alt="tes" class='max-w-md h-[15rem] w-[23rem] hidden lg:block'/>
                <div class='space-y-6 w-full lg:w-3/5'>
                    <h3 class='font-medium text-4xl'><span class='font-semibold'>Selamat Datang,</span> {{ Auth::user()->name }}</h3>
                    <p>Perpustakaan ini menyediakan koleksi buku lengkap, ruang baca nyaman, dan fasilitas untuk mendukung pembelajaran, menjadikannya tempat ideal untuk menambah pengetahuan.</p>
                    @if (Auth::user()->role == 'admin')
                      <div class="flex items-center gap-3">
                        <a href={{route('books.create')}} class='px-7 py-2 text-black hover:text-white bg-slate-300 rounded-full hover:bg-slate-400 transition-all duration-150'>Tambah Buku</a>
                        <a href={{route('books.inform')}} class='px-7 py-2 text-black hover:text-white bg-teal-700 rounded-full  hover:bg-teal-800 transition-all duration-150'>Riwayat Buku</a>
                      </div>
                    @endif
                </div>
            </div>
        
            <div>
                <div class='flex items-center justify-between my-7'>
                    <div>
                        <h3 class='text-xl font-medium'>Info Dashboard Buku</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet porro, dolorem iure quisquam neque velit voluptatum suscipit</p>
                    </div>
                    <a href={{route('books.index')}} class='px-5 py-1.5 bg-slate-300 text-black hover:text-white rounded-full hover:bg-slate-400 transition-all duration-150 font-medium'>Kelola</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 p-2">
                    <div class='text-9xl bg-[#6e987c] rounded-2xl text-white flex flex-col items-center justify-center p-6 space-y-10 shadow-md'>
                      <div class='flex items-center justify-between w-full '>
                        <h2 class='text-5xl me-2'><?= $book_count ?></h2>
                      </div>
                      <h4 class='text-lg'>Total Buku</h4>
                    </div>
        
                    <div class='text-9xl bg-[#22615D] rounded-2xl text-white flex flex-col items-center justify-center p-6 space-y-10 shadow-md'>
                      <div class='flex items-center justify-between w-full '>
                        <h2 class='text-5xl me-2'><?= $borrow_count ?></h2>
                      </div>
                      <h4 class='text-lg'>Sedang Dipinjam</h4>
                    </div>
        
                    <div class='text-9xl bg-[#FBC78F] rounded-2xl text-white flex flex-col items-center justify-center p-6 space-y-10 shadow-md'>
                      <div class='flex items-center justify-between w-full '>
                        <h2 class='text-5xl me-2'><?= $return_count ?></h2>
                      </div>
                      <h4 class='text-lg'>Sudah Dikembalikan</h4>
                    </div>
        
                    <div class='text-9xl bg-[#AC455E] rounded-2xl text-white flex flex-col items-center justify-center p-6 space-y-10 shadow-md'>
                      <div class='flex items-center justify-between w-full '>
                        <h2 class='text-5xl me-2'><?= $broken_book ?></h2>
                      </div>
                      <h4 class='text-lg'>Buku Rusak</h4>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </section>
</x-app-layout>
