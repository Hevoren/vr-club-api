<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\ChangeUserInfo;
use App\Http\Controllers\Api\ComputerController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\PageForgotPassword;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\RedirectForgotPasswordController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRequestController;
use App\Http\Controllers\Api\VerificationEmail;
use App\Http\Controllers\Api\VrDeviceController;
use Illuminate\Support\Facades\Route;

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

//for user/admin interaction
Route::group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['auth:sanctum', 'verify']], function () {
    Route::apiResource('computers', ComputerController::class);
    Route::apiResource('games', GameController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('vrdevices', VrDeviceController::class);
    Route::post('change-password', [ChangePasswordController::class, 'changePassword']);
    Route::post('change-user-info', [ChangeUserInfo::class, 'updateUserInfo']);
    Route::post('logout', [AuthController::class, 'logoutUser']);
});

//for admin interaction
Route::group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['admin', 'auth:sanctum']], function () {
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);

});

//email-verification
Route::get('/email/verify', [VerificationEmail::class, 'checkStatusVerification'])->name('verification.notice');
Route::post('/email/verify/resend', [VerificationEmail::class, 'resendVerificationEmail'])->name('verification.again');
Route::get('/email/verify/{id}/{hash}', [VerificationEmail::class, 'verifyUser'])->middleware('signed')->name('verification.verify');

//send/get requests
Route::post('requests', [UserRequestController::class, 'storeRequest']);
Route::get('requests', [UserRequestController::class, 'showRequest'])->middleware(['admin', 'auth:sanctum']);

// auth
Route::post('register', [AuthController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'loginUser']);

//redirect to forgot password page (NOT NEED!)
Route::get('/redirect-to-forgot-password', [RedirectForgotPasswordController::class, 'redirectToPage']);

//forgot password
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendEmailForgotPassword']);
Route::post('/reset-password-action', [ForgotPasswordController::class, 'resetEmailForgotPassword']);
