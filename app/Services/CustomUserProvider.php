<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

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
        dd('retrieve by token');
    }

    /**
     *
     */
    public function updateRememberToken(Authenticatable $user, $token): void
    {
        dd('update remember me');
    }

    /**
     *
     */
    public function retrieveByCredentials(array $credentials): User|null
    {
        return User::where('email', $credentials['login'])->orWhere('username', $credentials['login'])->first();
    }

    /**
     *
     */
    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        return Hash::check($credentials['password'], $user->password);
    }

    /**
     *
     */
    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false): void
    {
        dd('rehash password');
    }
}
