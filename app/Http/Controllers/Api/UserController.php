<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'full_name' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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

        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hash password
        $user->role = $request->input('role', 'PILOT');
        $user->company_name = $request->company_name;
        $user->phone_number = $request->phone_number;
        $user->company_address = $request->company_address;
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
            $userLogin = auth()->user();
            if (!$userLogin) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }
            $user = Auth::user();

            return response()->json([
                'message' => 'Profile retrieved successfully',
                'user' => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Profile retrieved failed',
            ], 400);
        }
    }
}
