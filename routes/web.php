<?php


use Illuminate\Support\Facades\Route;

// Rute untuk halaman login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Grup rute dengan middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Ganti dengan view dashboard Anda
    })->name('dashboard');

    // Tambahkan rute lain yang memerlukan autentikasi di sini
    Route::get('/profile', function () {
        return view('profile'); // Ganti dengan view profile Anda
    })->name('profile');
});