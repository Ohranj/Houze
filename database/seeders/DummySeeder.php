<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    /**
     *
     */
    public function run(): void
    {
        User::factory(1, [
            'email' => config('app.test_user_email'),
            'password' => Hash::make(config('app.test_user_password')),
            'username' => config('app.test_user_username')
        ])->create();

        User::factory(10)->create();
    }
}
