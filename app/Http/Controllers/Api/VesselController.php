<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vessel;

class VesselController extends Controller
{
    public function getAll()
    {
        $vessels = Vessel::all();
        return response()->json([
            'message' => 'Success',
            'data' => $vessels
        ], 200);
    }

    public function getVesselbyId($id)
    {
        $vessel = Vessel::find($id);
        if ($vessel) {
            return response()->json([
                'message' => 'Success',
                'data' => $vessel
            ], 200);
        } else {
            return response()->json([
                'message' => 'Vessel not found',
                'data' => null
            ], 404);
        }
    }

    public function createVessel(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $vessel = Vessel::create($request->all());

        return response()->json([
            'message' => 'Success',
            'data' => $vessel
        ], 201);
    }

    public function updateVessel(Request $request, $id)
    {
        $vessel = Vessel::find($id);
        if ($vessel) {
            $vessel->update($request->all());
            return response()->json([
                'message' => 'Success',
                'data' => $vessel
            ], 200);
        } else {
            return response()->json([
                'message' => 'Vessel not found',
                'data' => null
            ], 404);
        }
    }

    public function deleteVessel($id)
    {
        $vessel = Vessel::find($id);
        if ($vessel) {
            $vessel->delete();
            return response()->json([
                'message' => 'Success',
                'data' => $vessel
            ], 200);
        } else {
            return response()->json([
                'message' => 'Vessel not found',
                'data' => null
            ], 404);
        }
    }
}
