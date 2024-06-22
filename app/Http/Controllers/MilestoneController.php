<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Milestone\CreateMilestone;
use App\Actions\Milestone\DeleteMilestone;
use App\Actions\Milestone\UpdateMilestone;
use App\Http\Requests\UpdateMilestoneRequest;
use App\Models\Milestone;
use App\Traits\ReturnJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MilestoneController extends Controller
{
    use ReturnJsonResponse;

    /**
     *
     */
    public function index(): JsonResponse
    {
        $milestones = Milestone::whereBelongsTo(Auth::user(), 'user')->orderBy('order', 'asc')->get();
        $completedCount = $milestones->filter(fn ($x) => $x->complete)->count();
        $data = ['milestones' => $milestones, 'completedCount' => $completedCount];
        return $this->returnJson(success: true, message: 'Milestones retrieved', data: $data, status: 200);
    }

    /**
     *
     */
    public function destroy(Request $request, Milestone $milestone, DeleteMilestone $deleteMilestone): JsonResponse
    {
        DB::table('milestones')->where('order', '>', $milestone->order)->decrement('order');
        $deleteMilestone->execute($milestone);
        return $this->returnJson(success: true, message: 'Milestone deleted', data: [], status: 200);
    }

    /**
     *
     */
    public function update(UpdateMilestoneRequest $request, Milestone $milestone, UpdateMilestone $updateMilestone): JsonResponse
    {
        $params = $request->only(['text', 'complete', 'completed']);
        $updateMilestone->execute($milestone, $params);
        return $this->returnJson(success: true, message: 'Milestone updated', data: [], status: 201);
    }

    /**
     *
     */
    public function store(Request $request, CreateMilestone $createMilestone): JsonResponse
    {
        $request->validate([
            'text' => ['required', 'string', 'max:125']
        ]);
        $curHighestOrder = DB::table('milestones')->where('user_id', Auth::id())->max('order');
        $params = ['text' => $request->text, 'order' => ($curHighestOrder ?: 0) + 1];
        $createMilestone->execute($request->user(), $params);
        return $this->returnJson(success: true, message: 'Milestone created', data: [], status: 201);
    }
}
