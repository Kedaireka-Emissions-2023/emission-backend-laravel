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

        $emissions = Emission::with(['drone', 'vessel', 'port'])->paginate($limit, ['*'], 'page', $page);

        foreach ($emissions as $emission) {
            $emission->date = date('d F Y', strtotime($emission->date));
        }

        return response()->json([
            'message' => 'Success',
            'data' => $emissions
        ], 200);
    }

    public function getEmissionbyId($id)
    {
        $emission = Emission::with('drone', 'vessel', 'port')->find($id);
        if ($emission) {
            $emission->date = date('d F Y', strtotime($emission->date));
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
                'drone_id' => 'required|integer',
                'vessel_id' => 'required|integer',
                'port_id' => 'required|integer',
                'link' => 'required|string',
                'date' => 'required',
            ]);

            $emission = Emission::create($request->all());

            return response()->json([
                'message' => 'Success',
                'data' => $emission
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function updateEmission(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $emission = Emission::find($request->id);
        if ($emission) {
            try {
                $emission->update($request->all());

                return response()->json([
                    'message' => 'Success',
                    'data' => $emission
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Failed',
                    'data' => $e->getMessage()
                ], 500);
            }
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
            try {
                $emission->delete();

                return response()->json([
                    'message' => 'Success',
                    'data' => null
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Failed',
                    'data' => $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }
    }
}
