<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;

use App\Models\User;
use App\Models\Port;
use App\Models\Emission;
use App\Models\EmissionUser;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'email_recovery' => 'string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:PILOT,BKI,PORT',
            'company_name' => 'string|max:255',
            'phone_number' => 'string|max:255',
            'company_address' => 'string|max:255',

            'nik' => 'string|max:255',
            'status' => 'in:VALID,EXPIRED',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        if ($request->role == 'PORT') {
            $validator = Validator::make($request->all(), [
                'port_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 400);
            }

            $port = Port::where('id', $request->port_id)->first();

            if (!$port) {
                return response()->json([
                    'message' => 'Port not found',
                ], 404);
            }
        }

        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->email_recovery = $request->email_recovery;
        $user->password = Hash::make($request->password); // Hash password
        $user->role = $request->input('role', 'PILOT');
        $user->company_name = $request->company_name;
        $user->phone_number = $request->phone_number;
        $user->company_address = $request->company_address;
        $user->port_id = $request->port_id;

        $user->ktp = $request->ktp;
        $user->certificate = $request->certificate;
        $user->exp_certificate = $request->exp_certificate;
        $user->nik = $request->nik;
        $user->status = $request->input('status', 'EXPIRED');
        $user->save();

        $token = $user->createToken('authToken', ['*'], Carbon::now()->addHour(10));

        return response()->json([
            'message' => 'User successfully registered',
            'access_token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('authToken', ['*'], Carbon::now()->addHour(10));

            return response()->json([
                'message' => 'Login successful',
                'access_token' => $token,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }

            $userWithPort = User::with('port')->find($user->id);

            if (!$userWithPort) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            $userWithPort->makeHidden(['created_at', 'updated_at', 'email_verified_at']);

            return response()->json([
                'message' => 'Profile retrieved successfully',
                'user' => $userWithPort,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Profile retrieval failed',
            ], 400);
        }
    }

    public function getTotalPilotOnPort($portId)
    {
        // Find the port by port_id
        $port = Port::where('port_id', $portId)->first();

        if (!$port) {
            return response()->json([
                'message' => 'Failed',
                'data' => 'Port not found'
            ], 404);
        }

        // Count distinct users associated with emissions for the found port
        $pilots = Emission::where('port_id', $port->id)
                    ->with('users') // Eager load the users relationship
                    ->get()
                    ->pluck('users') // Extract the users collection from each emission
                    ->flatten() // Flatten the collection of collections into a single collection
                    ->unique('id') // Remove duplicates based on user id
                    ->count();

        return response()->json([
            'message' => 'Success',
            'data' => $pilots
        ], 200);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'full_name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'email_recovery' => 'string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8',
            'role' => 'in:PILOT,BKI,PORT',
            'company_name' => 'string|max:255',
            'phone_number' => 'string|max:255',
            'company_address' => 'string|max:255',
            'nik' => 'string|max:255',
            'status' => 'in:VALID,EXPIRED',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (($request->has('old_password') && $request->has('new_password') && $request->has('confirmation_password'))) {
            if ($request->new_password != $request->confirmation_password) {
                return response()->json([
                    'message' => 'New Password and Confirmation Password must be the same!',
                ], 400);
            }

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'message' => 'Old Password is incorrect',
                ], 400);
            }

            $user->password = Hash::make($request->new_password);
        } elseif ($request->has('new_password') || $request->has('confirmation_password')) {
            return response()->json([
                'message' => 'Old Password is required when updating the password',
            ], 400);
        } elseif ($request->has('old_password')) {
            return response()->json([
                'message' => 'New Password and Confirmation Password are required when updating the password',
            ], 400);
        }

        if ($request->hasFile('ktp')) {
            $user->ktp = $request->file('ktp')->store('ktp', 'public');
        }

        if ($request->hasFile('certificate')) {
            $user->certificate = $request->file('certificate')->store('certificate', 'public');
        }

        if ($request->has('full_name')) $user->full_name = $request->full_name;
        if ($request->has('email')) $user->email = $request->email;
        if ($request->has('email_recovery')) $user->email_recovery = $request->email_recovery;
        if ($request->has('password')) $user->password = Hash::make($request->password); // Hash password
        if ($request->has('role')) $user->role = $request->input('role', 'PILOT');
        if ($request->has('company_name')) $user->company_name = $request->company_name;
        if ($request->has('phone_number')) $user->phone_number = $request->phone_number;
        if ($request->has('company_address')) $user->company_address = $request->company_address;
        if ($request->has('nik')) $user->nik = $request->nik;
        if ($request->has('status')) $user->status = $request->input('status', 'EXPIRED');
        if ($request->has('exp_certificate')) $user->exp_certificate = $request->exp_certificate;

        $token = $user->createToken('authToken', ['*'], Carbon::now()->addHour(10));

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}
