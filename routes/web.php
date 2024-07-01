<?php

use App\Http\Controllers\Authenticate\AuthenticateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:web')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});

Route::middleware('guest')->group(function () {
    Route::get('/authenticate', [AuthenticateController::class, 'authenticate'])
        ->name('login');
});
