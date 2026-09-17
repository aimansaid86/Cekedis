<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');

Route::middleware('auth')->group(function () {
    Route::get('/jual', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/jual', [ListingController::class, 'store'])->name('listings.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register']);
    Route::get('/log-masuk', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/log-masuk', [AuthController::class, 'login']);
});
