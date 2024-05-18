<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Port;
use App\Models\User;

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

    public function reg()
    {
        $port = Port::all();
        return response()->json([
            'message' => 'Success',
            'data' => $port
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

    public function getTotalPort()
    {
        $total = Port::count();
        return response()->json([
            'message' => 'Success',
            'data' => $total
        ], 200);
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
            $port->port_id = $request->port_id;
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

    public function directGet($id)
    {
        $port = Port::where('id', $id)->first();
        $user = auth()->user();

        if ($user->role == 'PORT' && $user->port_id == $port->id) {
            if ($port) {
                return response()->json([
                    'message' => 'Success',
                    'data' => [
                        'port' => $port->only(['name', 'port_id', 'phone_number', 'city', 'office_address', 'port_document']),
                        'user' => $user->only(['full_name', 'email', 'role', 'email_recovery'])
                    ]
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Port not found',
                    'data' => null
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized',
                'data' => null
            ], 401);
        }
    }

    public function directUpdate(Request $request)
    {
        $port = Port::find($request->id);
        $user = auth()->user();

        if ($user->role == 'PORT' && $user->port_id == $port->id) {
            if ($port) {
                try{
                    if ($request->has('password') && $request->has('confirm_password')) {
                        if ($request->password != $request->confirm_password) {
                            return response()->json([
                                'message' => 'Password and Confirm Password must be the same',
                                'data' => null
                            ], 400);
                        }

                        if (!Hash::check($request->password, $user->password)) {
                            return response()->json([
                                'message' => 'Password is incorrect',
                                'data' => null
                            ], 400);
                        }
                    } else {
                        return response()->json([
                            'message' => 'Password and Confirm Password are required',
                            'data' => null
                        ], 400);
                    }

                    if ($request->hasFile('port_document')){
                        $port->port_document = $request->file('port_document')->store('port-document', 'public');
                    }

                    $user->full_name = $request->company_name ?? $user->full_name;
                    $user->email = $request->email ?? $user->email;
                    $user->role = $request->role ?? $user->role;
                    $user->email_recovery = $request->email_recovery ?? $user->email_recovery;
                    $port->name = $request->name ?? $port->name;
                    $port->port_id = $request->port_id ?? $port->port_id;
                    $port->phone_number = $request->phone_number ?? $port->phone_number;
                    $port->city = $request->city ?? $port->city;
                    $port->office_address = $request->office_address ?? $port->office_address;

                    $port->save();
                    $user->save();

                    return response()->json([
                        'message' => 'Success',
                        'data-port' => $port,
                        'data-user' => $user
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
        } else {
            return response()->json([
                'message' => 'Unauthorized',
                'data' => null
            ], 401);
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
