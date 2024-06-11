<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\ReturnJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsernameExistsController extends Controller
{
    use ReturnJsonResponse;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $exists = DB::table('users')->where('username', $request->username)->exists();
        return ! $exists
            ? $this->returnJson(success: true, message: 'Username valid', data: [], status: 200)
            : $this->returnJson(success: false, message: 'Username invalid', data: [], status: 422);
    }
}
