<?php

declare(strict_types=1);

use App\Http\Controllers\UsernameExistsController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function (): void {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});

Route::get('/validate-username-status', UsernameExistsController::class);


require __DIR__ . '/auth.php';
