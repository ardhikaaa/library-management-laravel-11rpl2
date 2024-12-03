<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\pinjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin']], function(){
Route::resource('books', BookController::class);
Route::get('books.inform', [BookController::class, 'inform'])->name('books.inform');
Route::put('/books/{id}/status', [BookController::class, 'status'])->name('books.status');
Route::resource('users', usersController::class);
});

Route::group(['middleware' => ['auth', 'role:anggota']], function(){
Route::resource('anggota', AnggotaController::class);
});

Route::post('book/perpanjang/{id}', [BookController::class, 'perpanjang'])->name('books.perpanjang');


require __DIR__.'/auth.php';
