<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Emission;

class EmissionController extends Controller
{
    public function getAll()
    {
        $emissions = Emission::all();
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
        $request->validate([
            'name' => 'required',
        ]);

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
