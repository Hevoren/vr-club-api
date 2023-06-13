<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangeUserInfo extends Controller
{

    public function updateUserInfo(Request $request)
    {
        $request->validate([
            'user_id' => 'integer',
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirm_password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'name' => 'sometimes|max:255',
            'surname' => 'sometimes|max:255',
        ]);

        $user = $request->user();

        if ($request->password === $request->confirm_password) {
            if (Hash::check($request->password, $user->password)) {
                $name = $request->has('name') ? $request->name : $user->name;
                $surname = $request->has('surname') ? $request->surname : $user->surname;

                $user->update([
                    'name' => $name,
                    'surname' => $surname,
                ]);

                return response()->json(['message' => 'Userinfo changed successfully'], 201);
            } else {
                return response()->json(['error' => 'Incorrect password'], 400);
            }
        } else {
            return response()->json(['error' => 'Passwords dont match'], 400);
        }

    }
}
