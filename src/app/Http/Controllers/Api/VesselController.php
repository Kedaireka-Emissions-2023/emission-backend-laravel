<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Http\Request;

use App\Models\Vessel;

class VesselController extends Controller
{
    public function getAll(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $vessels = Vessel::where('name', 'like', '%' . $query . '%')
            ->orWhere('imo_number', 'like', '%' . $query . '%')
            ->orWhere('type', 'like', '%' . $query . '%')
            ->paginate($limit, ['*'], 'page', $page);
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

    public function getTotalVessel()
    {
        $total = Vessel::count();
        return response()->json([
            'message' => 'Success',
            'data' => $total
        ], 200);
    }

    public function getTotalVesselWithEmissions()
    {
        try {
            $total = Vessel::count();
            $vesselWithEmission = Vessel::whereHas('emissions')->count();
            return response()->json([
                'message' => 'Success',
                'all' => $total,
                'withEmission' => $vesselWithEmission
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error getting total vessel',
                'data' => $e->getMessage()
            ], 400);
        }
    }

    public function getTotalVesselOnPort($portId)
    {
        try {
            $port = Port::where('port_id', $portId)->first();
            if (!$port) {
                return response()->json([
                    'message' => 'Port not found',
                    'data' => null
                ], 400);
            }

            $vesselWithEmission = Vessel::whereHas('emissions', function ($query) use ($port) {
                $query->where('port_id', $port->id);
            })->count();

            return response()->json([
                'message' => 'Success',
                'data' => $vesselWithEmission
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error getting total vessel',
                'data' => $e->getMessage()
            ], 400);
        }
    }


    public function createVessel(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'port_id' => 'required',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'data' => $e->getMessage()
            ], 400);
        }

        $port = Port::find($request->port_id);
        if (!$port) {
            return response()->json([
                'message' => 'Port not found',
                'data' => null
            ], 400);
        }

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
                'message' => 'Vessel deleted',
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
