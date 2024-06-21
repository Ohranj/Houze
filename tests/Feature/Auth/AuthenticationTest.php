<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     */
    public function test_user_can_login_via_email(): void
    {
        $response = $this->postJson('/login', [
            'login' => config('app.test_user_email'),
            'password' => config('app.test_user_password')
        ]);

        $response->assertStatus(202)->assertJson(['success' => true]);
    }

    /**
     *
     */
    public function test_user_can_login_via_username(): void
    {
        $response = $this->postJson('/login', [
            'login' => config('app.test_user_username'),
            'password' => config('app.test_user_password')
        ]);

        $response->assertStatus(202)->assertJson(['success' => true]);
    }

    /**
     *
     */
    public function test_incorrect_password_prevents_login(): void
    {
        $response = $this->postJson('/login', [
            'login' => config('test_user_email'),
            'password' => 'incorrectpassword'
        ]);

        $response->assertStatus(422);
    }

    /**
     *
     */
    public function test_login_not_exists_prevents_login(): void
    {
        $response = $this->postJson('/login', [
            'login' => fake()->email,
            'password' => config('test_user_password')
        ]);

        $response->assertStatus(422);
    }
}
