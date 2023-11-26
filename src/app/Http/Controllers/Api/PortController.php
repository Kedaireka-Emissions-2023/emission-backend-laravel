<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Port;

class PortController extends Controller
{
    public function getAll()
    {
        $ports = Port::all();
        return response()->json([
            'message' => 'Success',
            'data' => $ports
        ], 200);
    }

    public function getPortbyId($id)
    {
        $port = Port::find($id);
        if ($port) {
            return response()->json([
                'message' => 'Success',
                'data' => $port
            ], 200);
        } else {
            return response()->json([
                'message' => 'Port not found',
                'data' => null
            ], 404);
        }
    }

    public function createPort(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $port = Port::create($request->all());

        return response()->json([
            'message' => 'Success',
            'data' => $port
        ], 201);
    }

    public function updatePort(Request $request, $id)
    {
        $port = Port::find($id);
        if ($port) {
            $port->update($request->all());
            return response()->json([
                'message' => 'Success',
                'data' => $port
            ], 200);
        } else {
            return response()->json([
                'message' => 'Port not found',
                'data' => null
            ], 404);
        }
    }

    public function deletePort($id)
    {
        $port = Port::find($id);
        if ($port) {
            $port->delete();
            return response()->json([
                'message' => 'Success',
                'data' => $port
            ], 200);
        } else {
            return response()->json([
                'message' => 'Port not found',
                'data' => null
            ], 404);
        }
    }
}
