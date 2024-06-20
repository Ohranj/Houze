<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     *
     */
    public function messages(): array
    {
        return [
            '*' => 'Invalid credentials provided. Please check and try again.'
        ];
    }

    /**
     *
     */
    public function isRateLimited(): bool
    {
        return RateLimiter::tooManyAttempts($this->throttleKey(), 5);
    }

    /**
     *
     */
    public function rateLimiterAvailableIn(): int
    {
        return RateLimiter::availableIn($this->throttleKey());
        ;
    }

    /**
     *
     */
    public function incrementRateLimiter(): void
    {
        RateLimiter::hit($this->throttleKey());
    }

    /**
     *
     */
    public function clearRateLimiter(): void
    {
        RateLimiter::clear($this->throttleKey());
    }

    /**
     *
     */
    private function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
