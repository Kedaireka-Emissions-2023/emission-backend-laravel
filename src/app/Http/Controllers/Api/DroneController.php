<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Drone;

class DroneController extends Controller
{
    public function getAll(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');

        $drones = Drone::paginate($limit, ['*'], 'page', $page);

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

        $drone = Drone::create($request->all());

        return response()->json([
            'message' => 'Success',
            'data' => $drone
        ], 201);
    }

    public function updateDrone(Request $request, $id)
    {
        $drone = Drone::find($id);
        if ($drone) {
            $drone->update($request->all());
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
