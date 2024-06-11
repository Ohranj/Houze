<?php

declare(strict_types=1);

use App\Http\Controllers\UsernameExistsController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth'])->name('dashboard');

Route::get('/validate-username-status', UsernameExistsController::class);


require __DIR__ . '/auth.php';
