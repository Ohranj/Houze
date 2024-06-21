<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsernameExistsController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

Route::get('/validate-username-status', UsernameExistsController::class);


require __DIR__ . '/auth.php';
