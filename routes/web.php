<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Login routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    // Customers
    Route::resource('customers', CustomerController::class);

    // Services
    Route::resource('services', ServiceController::class);

    // Users
    Route::put('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    Route::resource('users', UserController::class);
});