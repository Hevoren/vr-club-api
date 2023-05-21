<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function registerUser(UserStoreRequest $request)
    {
        if (!Auth::check()) {
            if ($request->validated()) {

                $user = User::create([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'login' => $request->login,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role_id
                ]);

                $user = User::where('login', $request->login)->first();

                $token = null;
                if($user->role_id === 1) {
                    $token = $user->createToken('admin-token', ['create', 'update', 'delete']);
                } elseif ($user->role_id === 2) {
                    $token = $user->createToken('basic-token', ['none']);
                }

                if ($token) {
                    return response()->json([
                        'bearer' => $token->plainTextToken,
                    ]);
                } else {
                    return response()->json('Error creating token');
                }
            } else {
                return response()->json('Error registration');
            }
        } else {
            return response()->json('You are already logged in');
        }
    }

    public function loginUser(UserLoginRequest $request)
    {
        if ($request->validated()) {
            $credentials = $request->only('login', 'password');
            if (Auth::attempt($credentials)) {
                $user = User::where('login', $request->login)->first();

                $token = null;
                if($user->role_id === 1) {
                    $token = $user->createToken('admin-token', ['create', 'update', 'delete']);
                } elseif ($user->role_id === 2) {
                    $token = $user->createToken('basic-token', ['none']);
                }

                if ($token) {
                    return response()->json([
                        'bearer' => $token->plainTextToken,
                    ]);
                } else {
                    return response()->json('Error creating token');
                }
            } else {
                return response()->json('Invalid login or password', 422);
            }
        } else {
            return response()->json('Error login');
        }
    }

    public function logoutUser(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Logged out successfully');
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
