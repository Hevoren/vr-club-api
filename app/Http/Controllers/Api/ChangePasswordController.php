<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'integer',
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirm_password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'new_password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        $user = $request->user();

        if ($request->password === $request->confirm_password){
            if (Hash::check($request->password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);

                return response()->json(['message' => 'Password changed successfully'], 201);
            } else {
                return response()->json(['error' => 'Incorrect password'], 400);
            }
        } else {
            return response()->json(['error' => 'Passwords dont match'], 400);
        }

    }

    public function attributes()
    {
        return [
            'password' => 'Password',
            'confirm_password' => 'Confirm password',
            'new_password' => 'New password'
        ];
    }

    public function messages()
    {
        return [
            'password' => 'The :attribute must contain at least one lowercase letter, one uppercase letter and one digit.',
            'confirm_password' => 'The :attribute must contain at least one lowercase letter, one uppercase letter and one digit.',
            'new_password' => 'The :attribute must contain at least one lowercase letter, one uppercase letter and one digit.'
        ];
    }
}
