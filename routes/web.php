<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'view'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'handle'])
    ->name('login.handle')
    ->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');
});
