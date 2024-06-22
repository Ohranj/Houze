<?php

declare(strict_types=1);

namespace App\Actions\Milestone;

use App\Models\Milestone;

class DeleteMilestone
{
    public function execute(Milestone $milestone): void
    {
        $milestone->delete();
    }
}
