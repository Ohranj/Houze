<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ReturnJsonResponse
{
    public function returnJson(bool $success, string $message, array $data, int $status): JsonResponse
    {
        //Use rest params...
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data], $status);
    }
}
