<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VesselController;
use App\Http\Controllers\Api\DroneController;
use App\Http\Controllers\Api\PortController;
use App\Http\Controllers\Api\EmissionController;

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

Route::get('test', function () {
    return new JsonResponse([
        'message' => 'Hello from staging : ok!'
    ], 200);
});

Route::prefix('auth')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserController::class, 'profile']);

    Route::middleware('bki')->prefix('bki')->group(function () {
        // Vessel
        Route::get('vessels', [VesselController::class, 'getAll']);
        Route::get('vessels/{id}', [VesselController::class, 'getVesselbyId']);
        Route::post('vessels', [VesselController::class, 'createVessel']);
        Route::put('vessels/{id}', [VesselController::class, 'updateVessel']);
        Route::delete('vessels/{id}', [VesselController::class, 'deleteVessel']);

        // Drone
        Route::get('drones', [DroneController::class, 'getAll']);
        Route::get('drones/{id}', [DroneController::class, 'getDronebyId']);
        Route::post('drones', [DroneController::class, 'createDrone']);
        Route::put('drones/{id}', [DroneController::class, 'updateDrone']);
        Route::delete('drones/{id}', [DroneController::class, 'deleteDrone']);

    });

    Route::middleware('pilot')->prefix('pilot')->group(function () {
        // Drone
        Route::get('drones', [DroneController::class, 'getAll']);
        Route::get('drones/{id}', [DroneController::class, 'getDronebyId']);
        Route::post('drones', [DroneController::class, 'createDrone']);
        Route::put('drones/{id}', [DroneController::class, 'updateDrone']);
        Route::delete('drones/{id}', [DroneController::class, 'deleteDrone']);

        // Emission
        Route::get('emissions', [EmissionController::class, 'getAll']);
        Route::get('emissions/{id}', [EmissionController::class, 'getEmissionbyId']);
        Route::post('emissions', [EmissionController::class, 'createEmission']);
        Route::put('emissions/{id}', [EmissionController::class, 'updateEmission']);
        Route::delete('emissions/{id}', [EmissionController::class, 'deleteEmission']);
    });

    Route::middleware('port')->prefix('port')->group(function (){
        // Port
        Route::get('ports', [PortController::class, 'getAll']);
        Route::get('ports/{id}', [PortController::class, 'getPortbyId']);
        Route::post('ports', [PortController::class, 'createPort']);
        Route::put('ports/{id}', [PortController::class, 'updatePort']);
        Route::delete('ports/{id}', [PortController::class, 'deletePort']);
    });
});
