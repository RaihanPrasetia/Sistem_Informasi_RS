<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrugController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Grup rute dengan middleware auth
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/drug', [DrugController::class, 'index'])->name('drug.index');

    Route::get('/profile', function () {
        return view('profile'); // Ganti dengan view profile Anda
    })->name('profile');
});
