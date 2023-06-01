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
            'login' => 'required',
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'name' => 'sometimes|max:255',
            'surname' => 'sometimes|max:255',
        ]);

        $user = User::where('login', $request->login)->first();

        if (Hash::check($request->password, $user->password)) {
            $name = $request->has('name') ? $request->name : $user->name;
            $surname = $request->has('surname') ? $request->surname : $user->surname;

            $user->update([
                'name' => $name,
                'surname' => $surname,
            ]);

            return response()->json(['message' => 'Userinfo changed successfully']);
        } else {
            return response()->json(['message' => 'Error for updating userinfo']);
        }
    }
}
