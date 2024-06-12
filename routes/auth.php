<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\{
    AuthenticatedSessionController,
    ConfirmablePasswordController,
    NewPasswordController,
    PasswordController,
    PasswordResetLinkController,
    RegisteredUserController
};

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::post('register', RegisteredUserController::class)->middleware('throttle:3');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
