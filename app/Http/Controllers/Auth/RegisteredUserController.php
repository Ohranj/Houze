<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\User\CreateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Traits\ReturnJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    use ReturnJsonResponse;

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(RegisterRequest $request, CreateUser $createUser): JsonResponse
    {
        $user = $createUser->execute(params: $request->validated());

        //Fire an email as well
        //Auth::login($user);

        return $this->returnJson(success: true, message: 'Registration confirmed!', data: [], status: 201);
    }
}
