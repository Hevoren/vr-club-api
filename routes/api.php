<?php

use App\Http\Controllers\Api\EmployeeController;
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
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('games', GameController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('vrdevices', VrDeviceController::class);
});

Route::delete('statuses', [StatusController::class, 'destroyAll']);
Route::delete('employees', [EmployeeController::class, 'destroyAll']);
