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

Route::get('drones/{id}/cert/ins', [DroneController::class, 'get_cert_insurance']);
Route::get('drones/{id}/cert/ep', [DroneController::class, 'get_cert_emergency_procedure']);
Route::get('drones/{id}/cert/el', [DroneController::class, 'get_cert_equipment_list']);
Route::get('drones/{id}/cert/dp', [DroneController::class, 'get_cert_drone_photo']);
Route::get('drones/{id}/cert/dc', [DroneController::class, 'get_cert_drone_certificate']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserController::class, 'profile']);

    Route::middleware('role:BKI,PILOT,PORT')->group(function () {
        // Vessel
        Route::get('vessels', [VesselController::class, 'getAll']);
        Route::get('vessels/{id}', [VesselController::class, 'getVesselbyId']);

        // Drone
        Route::get('drones', [DroneController::class, 'getAll']);
        Route::get('drones/{id}', [DroneController::class, 'getDronebyId']);
        Route::post('drones', [DroneController::class, 'createDrone']);
        Route::put('drones/{id}', [DroneController::class, 'updateDrone']);
        Route::delete('drones/{id}', [DroneController::class, 'deleteDrone']);

        // Emission
        Route::get('emissions', [EmissionController::class, 'getAll']);
        Route::get('emissions/{id}', [EmissionController::class, 'getEmissionbyId']);

        // Port
        Route::get('ports', [PortController::class, 'getAll']);
        Route::get('ports/{id}', [PortController::class, 'getPortbyId']);
    });

    Route::middleware('role:BKI,PORT')->group(function () {
        // Vessel
        Route::post('vessels', [VesselController::class, 'createVessel']);
        Route::put('vessels/{id}', [VesselController::class, 'updateVessel']);
        Route::delete('vessels/{id}', [VesselController::class, 'deleteVessel']);
    });

    Route::middleware('role:BKI')->group(function () {
        // Port
        Route::post('ports', [PortController::class, 'createPort']);
        Route::put('ports/{id}', [PortController::class, 'updatePort']);
        Route::delete('ports/{id}', [PortController::class, 'deletePort']);
    });

    Route::middleware('role:PILOT')->group(function () {
        // Emission
        Route::post('emissions', [EmissionController::class, 'createEmission']);
        Route::put('emissions/{id}', [EmissionController::class, 'updateEmission']);
        Route::delete('emissions/{id}', [EmissionController::class, 'deleteEmission']);
    });
});
