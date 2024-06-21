<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\{
    AuthenticatedSessionController,
    NewPasswordController,
    PasswordController,
    PasswordResetLinkController,
    RegisteredUserController
};
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('/', WelcomeController::class);
    Route::post('register', RegisteredUserController::class)->middleware('throttle:3');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('throttle: 5')->name('login.store');


    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function (): void {
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
