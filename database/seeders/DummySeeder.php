<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     *
     */
    public function run(): void
    {
        User::factory(10)->create();
    }
}