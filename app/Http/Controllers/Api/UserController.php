<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Update\UserRoleUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        if ($user) {
            return UserResource::collection(User::all());
        } else {
            return response()->json(['message' => 'Users not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if ($user) {
            return new UserResource($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRoleUpdateRequest $request, string $id)
    {
        if ($request->validated()){
            $user = User::find($id);
            if ($user) {
                $user->update([
                    'role_id' => $request->role_id
                ]);
                return (new UserResource($user))
                    ->additional(['message' => 'User successfully updated'])
                    ->response()
                    ->setStatusCode(201);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
    }
}
