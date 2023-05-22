<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VrDeviceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ComputerController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\UserRequestController;

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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('computers', ComputerController::class);
    Route::apiResource('games', GameController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('vrdevices', VrDeviceController::class);
    Route::apiResource('requests', UserRequestController::class);
    Route::post('logout', [AuthController::class, 'logoutUser']);
});

Route::group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['admin', 'auth:sanctum' ]], function () {
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);

});

Route::post('register', [AuthController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'loginUser']);
