<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PageForgotPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

Route::get('{any}', function () {
    return view('welcome');
})->where('any','.*');

Route::get('/reset-password/{token}', [PageForgotPasswordController::class, 'getEmailForgotPassword'])->name('password.reset');
