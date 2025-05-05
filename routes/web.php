<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PeresepanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Grup rute dengan middleware auth
Route::middleware(['auth'])->group(function () {

    Route::resource('dashboard', DashboardController::class);

    Route::resource('patient', PatientController::class);
    Route::get('/api/states', [PatientController::class, 'getStates'])->name('api.states');
    Route::get('/api/cities', [PatientController::class, 'getCities'])->name('api.cities');

    Route::resource('country', CountryController::class);
    Route::resource('state', StateController::class);
    Route::resource('city', CityController::class);
    Route::resource('drug', DrugController::class);
    Route::resource('service', ServiceController::class);

    Route::post('/register/patient', [RegisterController::class, 'addPatient'])->name('register.patient');
    Route::resource('register', RegisterController::class);

    Route::get('/api/registration/{id}/drugs', [PeresepanController::class, 'getDrugs']);
    Route::resource('peresepan', PeresepanController::class)->except(['show']);

    Route::resource('transaction', TransactionController::class);



    Route::get('/profile', function () {
        return view('profile'); // Ganti dengan view profile Anda
    })->name('profile');
});
