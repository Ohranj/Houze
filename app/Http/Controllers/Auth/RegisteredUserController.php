<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Milestone\CreateMilestone;
use App\Actions\Network\CreateNetwork;
use App\Actions\User\CreateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Traits\ReturnJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    use ReturnJsonResponse;

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(RegisterRequest $request, CreateUser $createUser, CreateNetwork $createNetwork, CreateMilestone $createMilestone): JsonResponse
    {
        $user = $createUser->execute(params: $request->validated());

        $createNetwork->execute(user: $user);

        $milestones = $this->readMilestonesJsonAsArray();
        foreach ($milestones as $milestone) {
            $createMilestone->execute(user: $user, milestone: $milestone);
        }

        Auth::login(user: $user, remember: false);

        //Fire an email as well

        return $this->returnJson(success: true, message: 'Registration confirmed!', data: [], status: 201);
    }

    /**
     *
     */
    private function readMilestonesJsonAsArray(): array
    {
        $milestonesJson = json_decode(file_get_contents(base_path() . '/json/milestones.json', true));
        $milestones = [];
        foreach ($milestonesJson->milestones as $milestone) {
            $params = json_decode(json_encode($milestone), true);
            if ($milestone->complete) {
                $params['completed'] = Carbon::now()->toDateString();
            }
            $milestones[] = $params;
        }
        return $milestones;
    }
}
