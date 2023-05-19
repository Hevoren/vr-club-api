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


Route::apiResources([
    'computers' => ComputerController::class,
    'employees' => EmployeeController::class,
    'games' => GameController::class,
    'reservations' => ReservationController::class,
    'roles' => RoleController::class,
    'rooms' => RoomController::class,
    'statuses' => StatusController::class,
    'users' => UserController::class,
    'vrdevices' => VrDeviceController::class,
]);
Route::delete('statuses', [StatusController::class, 'destroyAll']);
Route::delete('employees', [EmployeeController::class, 'destroyAll']);
