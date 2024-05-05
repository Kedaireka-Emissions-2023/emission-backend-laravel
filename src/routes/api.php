<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VesselController;
use App\Http\Controllers\Api\DroneController;
use App\Http\Controllers\Api\PortController;
use App\Http\Controllers\Api\EmissionController;
use App\Http\Controllers\Api\EmissionResultController;
use App\Http\Controllers\Api\EmissionDataController;

Route::get('', function () {
    return new JsonResponse([
        'message' => 'Hello from production api : ok!'
    ], 200);
});

Route::prefix('auth')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
});

// Download Document
Route::get('download/{path}', [EmissionResultController::class, 'download'])
    ->where('path', '.*');

// Emission Data
Route::get('emission-data/{id}', [EmissionDataController::class, 'getEmissionData']);
Route::get('emission-data', [EmissionDataController::class, 'getAllEmissionData']);
Route::get('emission-data/check/{checkId}', [EmissionDataController::class, 'getEmissionDataByCheckId']);
Route::get('emission-data/check/filtered/{checkId}', [EmissionDataController::class, 'getEmissionDataByCheckIdFiltered']);
Route::get('emission-data/vessel/{vesseId}', [EmissionDataController::class, 'getEmissionDataByVesselId']);
Route::get('emission-data/drone/{droneId}', [EmissionDataController::class, 'getEmissionDataByDroneId']);
Route::get('emission-data/port/{portId}', [EmissionDataController::class, 'getEmissionDataByPortId']);
Route::post('emission-data', [EmissionDataController::class, 'createEmissionData']);
Route::post('emission-data/update', [EmissionDataController::class, 'updateEmissionData']);
Route::delete('emission-data/{id}', [EmissionDataController::class, 'deleteEmissionData']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('users/update', [UserController::class, 'update']);

    Route::middleware('role:BKI,PILOT,PORT')->group(function () {
        // Vessel
        Route::get('vessels', [VesselController::class, 'getAll']);
        Route::get('vessels/{id}', [VesselController::class, 'getVesselbyId']);
        Route::get('vessels/s/total', [VesselController::class, 'getTotalVessel']);

        // Drone
        Route::get('drones', [DroneController::class, 'getAll']);
        Route::get('drones/{id}', [DroneController::class, 'getDronebyId']);
        Route::get('drones/s/total', [DroneController::class, 'getTotalDrone']);
        Route::post('drones', [DroneController::class, 'createDrone']);
        Route::post('drones/update', [DroneController::class, 'updateDrone']);
        Route::delete('drones/{id}', [DroneController::class, 'deleteDrone']);

        // Emission
        Route::get('emissions', [EmissionController::class, 'getAll']);
        Route::get('emissions/{id}', [EmissionController::class, 'getEmissionbyId']);

        // Port
        Route::get('ports', [PortController::class, 'getAll']);
        Route::get('ports/{id}', [PortController::class, 'getPortbyId']);

        // Emission-Result
        Route::get('emission-results', [EmissionResultController::class, 'getAllEmissionResult']);
        Route::get('emission-results/{id}', [EmissionResultController::class, 'getEmissionResultbyId']);
        Route::get('emission-results/emission/{emissionId}', [EmissionResultController::class, 'getEmissionResultbyEmissionId']);
        Route::post('emission-results', [EmissionResultController::class, 'createEmissionResult']);
        Route::post('emission-results/update', [EmissionResultController::class, 'updateEmissionResult']);
        Route::delete('emission-results/{id}', [EmissionResultController::class, 'deleteEmissionResult']);

        // Custom
        // Get Total Vessel having emission and based on port ID
        Route::get('vessels/onport/{portId}', [VesselController::class, 'getTotalVesselOnPort']);
        // Get Total Drone having emission and based on port ID
        Route::get('drones/onport/{portId}', [DroneController::class, 'getTotalDroneOnPort']);
        // Get Total Pilot having emission and based on port ID
        Route::get('pilot/onport/{portId}', [UserController::class, 'getTotalPilotOnPort']);
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
        Route::post('ports/update', [PortController::class, 'updatePort']);
        Route::delete('ports/{id}', [PortController::class, 'deletePort']);
    });

    Route::middleware('role:BKI,PILOT')->group(function () {
        // Pilot
        Route::get('pilots', [UserController::class, 'getAllPilot']);
    });

    Route::middleware('role:PILOT,PORT')->group(function () {
        // Emission
        Route::post('emissions', [EmissionController::class, 'createEmission']);
        Route::post('update/emissions', [EmissionController::class, 'updateEmission']);
        Route::delete('emissions/{id}', [EmissionController::class, 'deleteEmission']);
    });
});
