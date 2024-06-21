<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Network;
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
        User::factory([
            'email' => config('app.test_user_email'),
            'password' => Hash::make(config('app.test_user_password')),
            'username' => config('app.test_user_username')
        ])->count(1)->create()->each(fn ($x) => $this->createUserNetwork($x, 'local'));

        User::factory()->count(10)->create()->each(fn ($x) => $this->createUserNetwork($x, 'local'));
    }

    /**
     *
     */
    private function createUserNetwork($user, $type): void
    {
        $user->network()->create([
            'network' => Network::TYPES[$type],
            'network_id' => null,
        ]);
    }
}
