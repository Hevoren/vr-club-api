<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\StatusController;
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
    'games' => GameController::class,
    'statuses' => StatusController::class,
    'employees' => EmployeeController::class
]);
Route::delete('statuses', [StatusController::class, 'destroyAll']);
Route::delete('employees', [EmployeeController::class, 'destroyAll']);
