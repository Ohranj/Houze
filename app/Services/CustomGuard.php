<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;

class CustomGuard implements StatefulGuard
{
    public const PREFIX = '46gf8';
    public $user = null;

    public function __construct(public $provider)
    {

    }

    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param  array  $credentials
     * @param  bool  $remember
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false)
    {
        dd('attempt');
        if ( ! $this->validate($credentials)) {
            return false;
        }

        $this->user = $this->user();
        $this->login($this->user, $remember);

        return true;
    }

    /**
     * Log a user into the application without sessions or cookies.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function once(array $credentials = [])
    {

    }

    /**
     * Log a user into the application.
     *
     * @param  Authenticatable  $user
     * @param  bool  $remember
     * @return void
     */
    public function login(Authenticatable $user, $remember = false): void
    {
        session([self::PREFIX . '_user_id' => $user->id]);
        $this->user = $user;
        // if ($remember) {
        //     $this->setRememberMe($user);
        // }
        session()->regenerate();
    }

    /**
     * Log the given user ID into the application.
     *
     * @param  mixed  $id
     * @param  bool  $remember
     * @return Authenticatable|false
     */
    public function loginUsingId($id, $remember = false)
    {

    }

    /**
     * Log the given user ID into the application without sessions or cookies.
     *
     * @param  mixed  $id
     * @return Authenticatable|false
     */
    public function onceUsingId($id)
    {
        return false;
    }

    /**
     * Determine if the user was authenticated via "remember me" cookie.
     *
     * @return bool
     */
    public function viaRemember()
    {
        return false;
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout(): void
    {

    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        $this->user();
        return false;
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return false;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return Authenticatable|null
     */
    public function user()
    {
        if ($this->user) {
            return $this->user;
        }

        $id = session(self::PREFIX . '_user_id', false);

        if ( ! $id) {
            return null;
        }

        $user = $this->provider->retrieveById(identifier: $id);

        if ( ! $user) {
            return null;
        }

        $self = $this->setUser($user);

        return $self->user;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|string|null
     */
    public function id()
    {
        return null;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        $user = $this->provider->retrieveByCredentials($credentials);

        if ( ! $user) {
            return false;
        }

        $validPassword = Hash::check($credentials['password'], $user->password);

        if ( ! $validPassword) {
            return false;
        }

        $this->setUser($user);

        return true;
    }

    /**
     * Determine if the guard has a user instance.
     *
     * @return bool
     */
    public function hasUser()
    {
        return false;
    }

    /**
     * Set the current user.
     *
     * @param  Authenticatable  $user
     * @return $this
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
        return $this;
    }
}
