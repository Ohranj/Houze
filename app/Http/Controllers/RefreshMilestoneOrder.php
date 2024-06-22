<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Milestone\UpdateMilestone;
use App\Models\Milestone;
use App\Traits\ReturnJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefreshMilestoneOrder extends Controller
{
    use ReturnJsonResponse;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, UpdateMilestone $updateMilestone): JsonResponse
    {
        $request->validate([
            'milestones' => ['required', 'array']
        ]);

        $milestones = Milestone::whereBelongsTo(Auth::user(), 'user')->get();

        foreach ($request->milestones as $newMilestone) {
            foreach ($milestones as $currentMilestone) {
                if ($newMilestone['id'] === $currentMilestone->id) {
                    if ($newMilestone['order'] !== $currentMilestone->order) {
                        $params = ['order' => $newMilestone['order']];
                        $updateMilestone->execute(milestone: $currentMilestone, params: $params);
                        continue;
                    }
                }
            }
        }

        return $this->returnJson(success: true, message: 'Milestones reordered', data: [], status: 202);
    }
}
