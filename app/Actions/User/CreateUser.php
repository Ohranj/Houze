<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function execute(array $params): User
    {
        return User::query()->create([
            'username' => $params['username'],
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
        ]);
    }
}
