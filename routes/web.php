<?php

use App\Http\Controllers\Api\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

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

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'getEmailForgotPassword'])->name('password.reset');
