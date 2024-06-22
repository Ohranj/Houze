<?php

declare(strict_types=1);

namespace App\Actions\Milestone;

use App\Models\User;

class CreateMilestone
{
    public function execute(User $user, array $milestone)
    {
        return $user->milestones()->create($milestone);
    }
}
