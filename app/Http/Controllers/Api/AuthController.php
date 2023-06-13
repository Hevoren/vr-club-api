<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function registerUser(UserStoreRequest $request)
    {
        if ($request->validated()) {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'login' => $request->login,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2
            ]);

            $user->sendEmailVerificationNotification();

            return response()->json(['message' => 'On your email has been send verification link'], 201);
        } else {
            return response()->json(['error' => 'Error registration', 400]);
        }
    }

    public function loginUser(UserLoginRequest $request)
    {
        if ($request->validated()) {
            $user = User::where('login', $request->login)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                if (!$user->email_verified_at) {
                    return response()->json(['error' => 'Account not verified'], 422);
                }

                $user->tokens()->delete();

                $token = null;
                if ($user->role_id === 1 || $user->role_id === 3) {
                    $token = $user->createToken('admin-token', ['create', 'update', 'delete']);
                } elseif ($user->role_id === 2) {
                    $token = $user->createToken('basic-token', ['none']);
                }
                if ($token) {
                    return response()->json(['bearer' => $token->plainTextToken, 'role_id' => $user->role_id]);
                } else {
                    return response()->json(['error' => 'Error creating token'], 400);
                }
            }
        }

        return response()->json(['error' => 'Invalid login or password'], 422);
    }


    public function logoutUser(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 201);
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
