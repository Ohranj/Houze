<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\CustomGuard;
use App\Services\CustomUserProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class CustomAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Auth::provider('customProvider', fn ($app, array $config) => new CustomUserProvider());

        Auth::extend(
            'session',
            fn (Application $app, string $name, array $config) => new CustomGuard(Auth::createUserProvider($config['provider']))
        );
    }
}
