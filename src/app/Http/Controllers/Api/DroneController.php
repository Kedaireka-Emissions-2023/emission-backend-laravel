<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Drone;

class DroneController extends Controller
{
    public function getAll(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $drones = Drone::where('name', 'like', '%' . $query . '%')
            ->orWhere('serial_number', 'like', '%' . $query . '%')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'message' => 'Success',
            'data' => $drones
        ], 200);
    }

    public function getDronebyId($id)
    {
        $drone = Drone::find($id);
        if ($drone) {
            return response()->json([
                'message' => 'Success',
                'data' => $drone
            ], 200);
        } else {
            return response()->json([
                'message' => 'Drone not found',
                'data' => null
            ], 404);
        }
    }

    public function getTotalDrone()
    {
        $total = Drone::count();
        $totalEmission = Drone::whereHas('emissions')->count();
        return response()->json([
            'message' => 'Success',
            'data' => [
                'Drone' => $total,
                'Drones with emission' => $totalEmission
            ]
        ], 200);
    }

    public function createDrone(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'data' => $e->getMessage()
            ], 400);
        }

        $drone = new Drone();

        if ($request->hasFile('cert_emergency_procedure')) {
            $drone->cert_emergency_procedure = $request->file('cert_emergency_procedure')->store('cert_emergency_procedure', 'public');
        }

        if ($request->hasFile('cert_insurance_doc')) {
            $drone->cert_insurance_doc = $request->file('cert_insurance_doc')->store('cert_insurance_doc', 'public');
        }

        if ($request->hasFile('cert_equipment_list')) {
            $drone->cert_equipment_list = $request->file('cert_equipment_list')->store('cert_equipment_list', 'public');
        }

        if ($request->hasFile('cert_drone_photo')) {
            $drone->cert_drone_photo = $request->file('cert_drone_photo')->store('cert_drone_photo', 'public');
        }

        if ($request->hasFile('cert_drone_certificate')) {
            $drone->cert_drone_certificate = $request->file('cert_drone_certificate')->store('cert_drone_certificate', 'public');
        }

        $drone->name = $request->name;
        $drone->serial_number = $request->serial_number;
        $drone->weight_no_payload = $request->weight_no_payload;
        $drone->cruise_speed = $request->cruise_speed;
        $drone->climb_max_rate = $request->climb_max_rate;
        $drone->volume_payload_size = $request->volume_payload_size;
        $drone->wing_material = $request->wing_material;
        $drone->fuselage_material = $request->fuselage_material;
        $drone->filesave_system = $request->filesave_system;
        $drone->control_system = $request->control_system;
        $drone->max_takeoff_weight = $request->max_takeoff_weight;
        $drone->max_flight_range = $request->max_flight_range;
        $drone->max_speed = $request->max_speed;
        $drone->max_cruise_height = $request->max_cruise_height;
        $drone->operational_payload_weight = $request->operational_payload_weight;
        $drone->proximity_sensor = $request->proximity_sensor;
        $drone->precision_landinig_mechanism = $request->precision_landinig_mechanism;
        $drone->operation_system = $request->operation_system;
        $drone->communication_system = $request->communication_system;
        $drone->description = $request->description;
        $drone->expiration_date = $request->expiration_date;
        $drone->save();

        return response()->json([
            'message' => 'Success',
            'data' => $drone
        ], 201);
    }

    public function updateDrone(Request $request)
    {
        $drone = Drone::find($request->$id);
        if ($drone) {
            $drone->name = $request->name ?? $drone->name;
            $drone->serial_number = $request->serial_number ?? $drone->serial_number;
            $drone->weight_no_payload = $request->weight_no_payload ?? $drone->weight_no_payload;
            $drone->cruise_speed = $request->cruise_speed ?? $drone->cruise_speed;
            $drone->climb_max_rate = $request->climb_max_rate ?? $drone->climb_max_rate;
            $drone->volume_payload_size = $request->volume_payload_size ?? $drone->volume_payload_size;
            $drone->wing_material = $request->wing_material ?? $drone->wing_material;
            $drone->fuselage_material = $request->fuselage_material ?? $drone->fuselage_material;
            $drone->filesave_system = $request->filesave_system ?? $drone->filesave_system;
            $drone->control_system = $request->control_system ?? $drone->control_system;
            $drone->max_takeoff_weight = $request->max_takeoff_weight ?? $drone->max_takeoff_weight;
            $drone->max_flight_range = $request->max_flight_range ?? $drone->max_flight_range;
            $drone->max_speed = $request->max_speed ?? $drone->max_speed;
            $drone->max_cruise_height = $request->max_cruise_height ?? $drone->max_cruise_height;
            $drone->operational_payload_weight = $request->operational_payload_weight ?? $drone->operational_payload_weight;
            $drone->proximity_sensor = $request->proximity_sensor ?? $drone->proximity_sensor;
            $drone->precision_landinig_mechanism = $request->precision_landinig_mechanism ?? $drone->precision_landinig_mechanism;
            $drone->operation_system = $request->operation_system ?? $drone->operation_system;
            $drone->communication_system = $request->communication_system ?? $drone->communication_system;
            $drone->description = $request->description ?? $drone->description;
            if($request->hasFile('cert_emergency_procedure')){
                Storage::delete($drone->cert_emergency_procedure);
                $drone->cert_emergency_procedure = $request->file('cert_emergency_procedure')->store('cert_emergency_procedure', 'public');
            }
            if($request->hasFile('cert_insurance_doc')){
                Storage::delete($drone->cert_insurance_doc);
                $drone->cert_insurance_doc = $request->file('cert_insurance_doc')->store('cert_insurance_doc', 'public');
            }
            if($request->hasFile('cert_equipment_list')){
                Storage::delete($drone->cert_equipment_list);
                $drone->cert_equipment_list = $request->file('cert_equipment_list')->store('cert_equipment_list', 'public');
            }
            if($request->hasFile('cert_drone_photo')){
                Storage::delete($drone->cert_drone_photo);
                $drone->cert_drone_photo = $request->file('cert_drone_photo')->store('cert_drone_photo', 'public');
            }
            if($request->hasFile('cert_drone_certificate')){
                Storage::delete($drone->cert_drone_certificate);
                $drone->cert_drone_certificate = $request->file('cert_drone_certificate')->store('cert_drone_certificate', 'public');
            }
            $drone->expiration_date = $request->expiration_date ?? $drone->expiration_date;
            return response()->json([
                'message' => 'Drone updated!',
                'data' => $drone
            ], 200);
        } else {
            return response()->json([
                'message' => 'Drone not found!',
                'data' => null
            ], 404);
        }
    }

    public function deleteDrone($id)
    {
        $drone = Drone::find($id);
        if ($drone) {
            $drone->delete();
            return response()->json([
                'message' => 'Drone deleted',
                'data' => $drone
            ], 200);
        } else {
            return response()->json([
                'message' => 'Drone not found',
                'data' => null
            ], 404);
        }
    }
}
