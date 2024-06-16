<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'testing123',
            'email' => 'test@example.com',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        $response->assertStatus(201)->assertJson(['success' => true]);
    }

    /**
     *
     */
    public function test_none_matching_password_fail_a_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'testing123',
            'email' => 'test@example.com',
            'password' => 'password1234',
            'password_confirmation' => 'password12345678',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrorFor('password');
    }

    /**
     *
     */
    public function test_short_password_length_fail_a_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'testing123',
            'email' => 'test@example.com',
            'password' => 'passwor',
            'password_confirmation' => 'passwor',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrorFor('password');
    }

    /**
     *
     */
    public function test_no_password_numbers_fail_a_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'testing123',
            'email' => 'test@example.com',
            'password' => 'passwordpassword',
            'password_confirmation' => 'passwordpassword',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrorFor('password');
    }

    /**
     *
     */
    public function test_email_already_exist_fail_a_register(): void
    {
        $this->postJson('/register', [
            'username' => 'TestingUser1',
            'email' => 'test@example.com',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        $response2 = $this->postJson('/register', [
            'username' => 'TestingUser2',
            'email' => 'test@example.com',
            'password' => 'password5678',
            'password_confirmation' => 'password5678',
        ]);

        $response2->assertStatus(422)->assertJsonValidationErrorFor('email');
    }
}
