<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StripeController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\StatisticController;

Route::get('/', [ProductController::class, 'index'])->name('shopping');
Route::get('/statistic', [StatisticController::class, 'index'])->name('statistic');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::get('/success', [StripeController::class, 'success'])->name('success');


require __DIR__.'/auth.php';
