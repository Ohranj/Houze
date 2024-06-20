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
        User::factory(10)->create();
        User::factory(1, [
            'email' => 'test@example.com',
            'password' => Hash::make('password12345678'),
            'username' => 'testuser'
        ])->create();
    }
}
