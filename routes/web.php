<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Login routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return "Dashboard";
    })->name('home');
});