<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Port;

class PortController extends Controller
{
    public function getAll(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $ports = Port::where('name', 'like', '%' . $query . '%')
            ->orWhere('city', 'like', '%' . $query . '%')
            ->paginate($limit, ['*'], 'page', $page);

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
        try{
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
            $port = new Port();

            if ($request->hasFile('port_document'))
                $port->port_document = $request->file('port_document')->store('port-document', 'public');
            else
                $port->port_document = null;

            $port->name = $request->name;
            $port->operator_address = $request->operator_address;
            $port->office_address = $request->office_address;
            $port->city = $request->city;
            $port->phone_number = $request->phone_number;
            $port->longitude = $request->longitude;
            $port->latitude = $request->latitude;
            $port->save();

            return response()->json([
                'message' => 'Success',
                'data' => $port
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create port',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePort(Request $request)
    {
        $port = Port::find($request->id);
        if ($port) {
            try{
                if ($request->hasFile('port_document'))
                    $port->port_document = $request->file('port_document')->store('port-document', 'public');

                $port->name = $request->name ?? $port->name;
                $port->operator_address = $request->operator_address ?? $port->operator_address;
                $port->office_address = $request->office_address ?? $port->office_address;
                $port->city = $request->city ?? $port->city;
                $port->phone_number = $request->phone_number ?? $port->phone_number;
                $port->longitude = $request->longitude ?? $port->longitude;
                $port->latitude = $request->latitude ?? $port->latitude;
                $port->save();

                return response()->json([
                    'message' => 'Success',
                    'data' => $port
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Failed to update port',
                    'error' => $e->getMessage()
                ], 500);
            }
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
