<?php

declare(strict_types=1);

namespace App\Actions\Milestone;

use App\Models\Milestone;

class UpdateMilestone
{
    public function execute(Milestone $milestone, array $params): void
    {
        $milestone->update($params);
    }
}
