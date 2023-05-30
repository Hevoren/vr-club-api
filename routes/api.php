<?php

use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageForgotPassword;
use App\Http\Controllers\Api\PageResetPassword;
use App\Http\Controllers\Api\RedirectForgotPasswordController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerificationEmail;
use App\Http\Controllers\Api\VrDeviceController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PageForgotPasswordController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ComputerController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\UserRequestController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['auth:sanctum', 'verify']], function () {
    Route::apiResource('computers', ComputerController::class);
    Route::apiResource('games', GameController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('vrdevices', VrDeviceController::class);
    Route::apiResource('requests', UserRequestController::class);
    Route::post('change-password', [ChangePasswordController::class, 'changePassword']);
    Route::post('logout', [AuthController::class, 'logoutUser']);
});

Route::group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['admin', 'auth:sanctum']], function () {
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);

});
Route::get('/email/verify', [VerificationEmail::class, 'checkStatusVerification'])->name('verification.notice');
Route::get('/email/verify/resend', [VerificationEmail::class, 'resendVerificationEmail'])->name('verification.again');
Route::get('/email/verify/{id}/{hash}', [VerificationEmail::class, 'verifyUser'])->middleware('signed')->name('verification.verify');

Route::get('/redirect-to-forgot-passwor.
', [RedirectForgotPasswordController::class, 'redirectToPage']);

Route::post('register', [AuthController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'loginUser']);

Route::apiResource('/forgot-password', PageForgotPassword::class);
Route::post('/reset-password-action', [PageForgotPasswordController::class, 'resetEmailForgotPassword']);
