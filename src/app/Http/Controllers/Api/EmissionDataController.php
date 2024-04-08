<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmissionData;
use App\Models\Emission;

class EmissionDataController extends Controller
{
    public function getEmissionData($id)
    {
        try {
            $emissionData = EmissionData::find($id);
            return response()->json($emissionData, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Emission Data not found!'
            ], 404);
        }
    }

    public function getAllEmissionData(Request $request){
        try {
            $page = $request->query('page');
            $limit = $request->query('limit');
            $query = $request->query('q');

            $emissionData = EmissionData::where('CO2', 'like', '%' . $query . '%')
                ->orWhere('CO', 'like', '%' . $query . '%')
                ->orWhere('NO2', 'like', '%' . $query . '%')
                ->orWhere('NO', 'like', '%' . $query . '%')
                ->orWhere('SO2', 'like', '%' . $query . '%')
                ->orWhere('PM10', 'like', '%' . $query . '%')
                ->orWhere('PM2_5', 'like', '%' . $query . '%')
                ->paginate($limit, ['*'], 'page', $page);

            return response()->json([
                'message' => 'Success',
                'data' => $emissionData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Emission Data not found!'
            ], 404);
        }
    }

    public function getEmissionDataByCheckId($checkId){
        try {
            $emissionData = EmissionData::whereHas('emission', function($query) use ($checkId){
                $query->where('checking_id', $checkId);
            })->get();

            return response()->json([
                'message' => 'Success',
                'data' => $emissionData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Emission Data not found!'
            ], 404);
        }
    }

    public function getEmissionDataByVesselId($vesselId){
        try {
            $emissionData = EmissionData::whereHas('emission', function($query) use ($vesselId){
                $query->where('vessel_id', $vesselId);
            })->get();

            return response()->json([
                'message' => 'Success',
                'data' => $emissionData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Emission Data not found!'
            ], 404);
        }
    }

    public function getEmissionDataByDroneId($droneId){
        try {
            $emissionData = EmissionData::whereHas('emission', function($query) use ($droneId){
                $query->where('drone_id', $droneId);
            })->get();

            return response()->json([
                'message' => 'Success',
                'data' => $emissionData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Emission Data not found!'
            ], 404);
        }
    }

    public function getEmissionDataByPortId($portId){
        try {
            $emissionData = EmissionData::whereHas('emission', function($query) use ($portId){
                $query->where('port_id', $portId);
            })->get();

            return response()->json([
                'message' => 'Success',
                'data' => $emissionData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Emission Data not found!'
            ], 404);
        }
    }

    public function createEmissionData(Request $request){
        try {
            $request->validate([
                'checking_id' => 'required',
                'vessel_id' => 'required',
                'drone_id' => 'required',
                'port_id' => 'required',
                'date' => 'required',
            ]);

            $emission = Emission::where('checking_id', $request->checking_id)->first();
            if(!$emission){
                $emission = Emission::create([
                    'checking_id' => $request->checking_id,
                    'vessel_id' => $request->vessel_id,
                    'drone_id' => $request->drone_id,
                    'port_id' => $request->port_id,
                    'date' => $request->date,
                ]);
            }

            $emissionData = EmissionData::create([
                'emission_id' => $emission->id,
                'CO2' => $request->CO2,
                'CO' => $request->CO,
                'NO2' => $request->NO2,
                'NO' => $request->NO,
                'SO2' => $request->SO2,
                'PM10' => $request->PM10,
                'PM2_5' => $request->PM2_5,
                'date' => $request->date,
                'time' => $request->time,
                'altitude' => $request->altitude,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return response()->json([
                'message' => 'Success',
                'data' => $emissionData
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Create Emission Data Failed',
                'data' => $e->getMessage()
            ], 400);
        }
    }

    public function updateEmissionData(Request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $emissionData = Emission
                ::where('id', $request->id)
                ->update($request->all());

            return response()->json([
                'message' => 'Success',
                'data' => $emissionData
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Update Emission Data Failed',
                'data' => $e->getMessage()
            ], 400);
        }
    }

    public function deleteEmissionData($id){
        try {
            $emissionData = EmissionData::find($id);
            $emissionData->delete();

            return response()->json([
                'message' => 'Success',
                'data' => $emissionData
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete Emission Data Failed',
                'data' => $e->getMessage()
            ], 400);
        }
    }
}
