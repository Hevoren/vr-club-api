<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assignedto the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'ControllerUser']);

Route::get('/gabellaTokenAccess', function () {
    $credentials = [
        'email' => 'admin@mail.com',
        'password' => 'ADMINadmin123',
    ];

    if (!Auth::attempt($credentials)) {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            $user = new User();

            $user->name = 'admin';
            $user->surname = 'adminov';
            $user->login = 'admin';
            $user->email = $credentials['email'];
            $user->password = Hash::make($credentials['password']);

            $user->save();
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('update-token', ['create', 'update']);
            $basicToken = $user->createToken('basic-token');

            if ($adminToken && $updateToken && $basicToken) {
                return [
                    'admin' => $adminToken->plainTextToken,
                    'update' => $updateToken->plainTextToken,
                    'basic' => $basicToken->plainTextToken
                ];
            }
        }
    }
});
