<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrugController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Grup rute dengan middleware auth
Route::middleware(['auth'])->group(function () {

    Route::resource('/dashboard', DashboardController::class);

    Route::resource('/drug', DrugController::class);

    Route::get('/profile', function () {
        return view('profile'); // Ganti dengan view profile Anda
    })->name('profile');
});
