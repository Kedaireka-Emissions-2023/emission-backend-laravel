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

Route::get('', function () {
    return new JsonResponse([
        'message' => 'Hello from production api : ok!'
    ], 200);
});

Route::prefix('auth')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
});

// Drone Certificate
Route::get('drones/{id}/cert/ins', [DroneController::class, 'get_cert_insurance']);
Route::get('drones/{id}/cert/ep', [DroneController::class, 'get_cert_emergency_procedure']);
Route::get('drones/{id}/cert/el', [DroneController::class, 'get_cert_equipment_list']);
Route::get('drones/{id}/cert/dp', [DroneController::class, 'get_cert_drone_photo']);
Route::get('drones/{id}/cert/dc', [DroneController::class, 'get_cert_drone_certificate']);

// Port Document
Route::get('ports/{id}/doc', [PortController::class, 'get_port_document']);

// Download Result Emission Document
Route::get('emission-results/download/{path}', [EmissionResultController::class, 'download'])
    ->where('path', '.*');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('users/update', [UserController::class, 'update']);

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

        // Emission-Result
        Route::get('emission-results', [EmissionResultController::class, 'getAllEmissionResult']);
        Route::get('emission-results/{id}', [EmissionResultController::class, 'getEmissionResultbyId']);
        // Get emission result by emission id
        Route::get('emission-results/emission/{emissionId}', [EmissionResultController::class, 'getEmissionResultbyEmissionId']);
        Route::post('emission-results', [EmissionResultController::class, 'createEmissionResult']);
        Route::post('emission-results/update', [EmissionResultController::class, 'updateEmissionResult']);
        Route::delete('emission-results/{id}', [EmissionResultController::class, 'deleteEmissionResult']);
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

    Route::middleware('role:BKI,PILOT')->group(function () {
        // Pilot
        Route::get('pilots', [UserController::class, 'getAllPilot']);
    });

    Route::middleware('role:PILOT')->group(function () {
        // Emission
        Route::post('emissions', [EmissionController::class, 'createEmission']);
        Route::post('update/emissions', [EmissionController::class, 'updateEmission']);
        Route::delete('emissions/{id}', [EmissionController::class, 'deleteEmission']);
    });
});
