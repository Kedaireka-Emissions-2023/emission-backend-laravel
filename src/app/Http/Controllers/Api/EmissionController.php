<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Emission;

class EmissionController extends Controller
{
    public function getAll(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');

        $emissions = Emission::paginate($limit, ['*'], 'page', $page);
        return response()->json([
            'message' => 'Success',
            'data' => $emissions
        ], 200);
    }

    public function getEmissionbyId($id)
    {
        $emission = Emission::find($id);
        if ($emission) {
            return response()->json([
                'message' => 'Success',
                'data' => $emission
            ], 200);
        } else {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }
    }

    public function createEmission(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'drone_id' => 'required',
                'vessel_id' => 'required',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'data' => $e->getMessage()
            ], 400);
        }

        $emission = Emission::create($request->all());

        return response()->json([
            'message' => 'Success',
            'data' => $emission
        ], 201);
    }

    public function updateEmission(Request $request, $id)
    {
        $emission = Emission::find($id);
        if ($emission) {
            $emission->update($request->all());
            return response()->json([
                'message' => 'Success',
                'data' => $emission
            ], 200);
        } else {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }
    }

    public function deleteEmission($id)
    {
        $emission = Emission::find($id);
        if ($emission) {
            $emission->delete();
            return response()->json([
                'message' => 'Success',
                'data' => $emission
            ], 200);
        } else {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }
    }
}
