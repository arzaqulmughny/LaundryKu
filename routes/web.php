<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Livewire\Pages\Transactions\Create;
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

    // Transactions
    Route::get('/transactions/{transaction}/export', [TransactionController::class, 'export'])->name('transactions.export');
    Route::resource('transactions', TransactionController::class);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Settings
    Route::delete('/settings/reset-all', [SettingController::class, 'resetAll'])->name('settings.resetAll');
    Route::delete('/settings/{setting}/reset', [SettingController::class, 'reset'])->name('settings.reset');
    Route::resource('/settings', SettingController::class)->names('settings');
});