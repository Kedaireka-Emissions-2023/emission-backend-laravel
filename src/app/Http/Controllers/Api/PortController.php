<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Port;

class PortController extends Controller
{
    public function getAll(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');

        $ports = Port::paginate($limit, ['*'], 'page', $page);
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
