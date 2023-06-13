<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class CurrentUserController extends Controller
{
    public function showUser(Request $request)
    {
        $user = $request->user();
        $user = new UserResource($user);
        return response()->json(['current_user' => $user], 201);
    }
}
