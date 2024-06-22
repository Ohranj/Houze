<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\Milestone\CreateMilestone;
use App\Actions\Network\CreateNetwork;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    /**
     *
     */
    public function run(CreateMilestone $createMilestone, CreateNetwork $createNetwork): void
    {
        $milestones = $this->readMilestonesJson();

        User::factory([
            'email' => config('app.test_user_email'),
            'password' => Hash::make(config('app.test_user_password')),
            'username' => config('app.test_user_username')
        ])
            ->count(1)
            ->create()
            ->each(function ($x) use ($createMilestone, $milestones, $createNetwork): void {
                $createNetwork->execute(user: $x, type: 'local');
                foreach ($milestones as $milestone) {
                    $createMilestone->execute(user: $x, milestone: $milestone);
                }
            });

        User::factory()
            ->count(10)
            ->create()
            ->each(function ($x) use ($createMilestone, $milestones, $createNetwork): void {
                $createNetwork->execute(user: $x, type: 'local');
                foreach ($milestones as $milestone) {
                    $createMilestone->execute(user: $x, milestone: $milestone);
                }
            });
    }

    /**
     *
     */
    private function readMilestonesJson(): array
    {
        $milestonesJson = json_decode(file_get_contents(base_path() . '/json/milestones.json'));
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
