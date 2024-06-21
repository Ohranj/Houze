<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'testing123',
            'email' => fake()->email,
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        $response->assertStatus(201)->assertJson(['success' => true]);
    }

    /**
     *
     */
    public function test_none_matching_password_fails_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'testing123',
            'email' => fake()->email,
            'password' => 'password1234',
            'password_confirmation' => 'password12345678',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrorFor('password');
    }

    /**
     *
     */
    public function test_short_password_length_fails_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'testing123',
            'email' => fake()->email,
            'password' => 'passwor',
            'password_confirmation' => 'passwor',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrorFor('password');
    }

    /**
     *
     */
    public function test_no_password_numbers_fails_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'testing123',
            'email' => fake()->email,
            'password' => 'passwordpassword',
            'password_confirmation' => 'passwordpassword',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrorFor('password');
    }

    /**
     *
     */
    public function test_email_already_exist_fails_register(): void
    {
        $response = $this->postJson('/register', [
            'username' => 'TestingUser2',
            'email' => config('app.test_user_email'),
            'password' => 'password5678',
            'password_confirmation' => 'password5678',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrorFor('email');
    }
}
