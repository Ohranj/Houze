<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class CustomUserProvider implements UserProvider
{
    /**
     *
     */
    public function retrieveById($identifier): User|null
    {
        return User::where('id', $identifier)->first();
    }

    /**
     *
     */
    public function retrieveByToken($identifier, $token): void
    {
        dd(2);
    }

    /**
     *
     */
    public function updateRememberToken(Authenticatable $user, $token): void
    {

    }

    /**
     *
     */
    public function retrieveByCredentials(array $credentials): void
    {
        dd($credentials, 'retrieve credentials');
    }

    /**
     *
     */
    public function validateCredentials(Authenticatable $user, array $credentials): void
    {

    }

    /**
     *
     */
    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false): void
    {

    }
}
