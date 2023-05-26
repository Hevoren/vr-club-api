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

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/forgot-password', [ForgotPasswordController::class])->name('forgot-password');
Route::get('/forgot-password', [PageForgotPasswordController::class, 'renderPageForgotPassword'])->name('password.request');

Route::post('/forgot-password', [PageForgotPasswordController::class, 'sendEmailForgotPassword'])->name('password.email');

Route::get('/reset-password/{token}', [PageForgotPasswordController::class, 'getEmailForgotPassword'])->name('password.reset');

Route::post('/reset-password', [PageForgotPasswordController::class, 'resetEmailForgotPassword'])->name('password.update');
