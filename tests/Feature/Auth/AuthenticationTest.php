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
            'login' => 'test@example.com',
            'password' => 'password12345678'
        ]);

        $response->assertStatus(202)->assertJson(['success' => true]);
    }

    /**
     *
     */
    public function test_user_can_login_via_username(): void
    {
        $response = $this->postJson('/login', [
            'login' => 'testuser',
            'password' => 'password12345678'
        ]);

        $response->assertStatus(202)->assertJson(['success' => true]);
    }

    /**
     *
     */
    public function test_incorrect_password_prevents_login(): void
    {
        $response = $this->postJson('/login', [
            'login' => 'testuser',
            'password' => 'incorrectpassword'
        ]);

        $response->assertStatus(422);
    }
}
