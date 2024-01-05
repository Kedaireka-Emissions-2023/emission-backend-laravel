<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;

use App\Models\User;

use Yaza\LaravelGoogleDriveStorage\Gdrive;
use Illuminate\Support\Facades\Storage;
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

        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->email_recovery = $request->email_recovery;
        $user->password = Hash::make($request->password); // Hash password
        $user->role = $request->input('role', 'PILOT');
        $user->company_name = $request->company_name;
        $user->phone_number = $request->phone_number;
        $user->company_address = $request->company_address;

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

    public function getAllPilot(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');

        $pilots = User::where('role', 'PILOT')->paginate($limit, ['*'], 'page', $page);
        return response()->json([
            'message' => 'Success',
            'data' => $pilots
        ], 200);
    }

    private function uploadToDrive($image)
    {
        $path = $image->store('public/images');
        $imageUrl = Storage::path($path);

        Gdrive::put($imageUrl, $image);

        //delete storage
        Storage::delete($path);
        return $path;
    }

    public function update(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user

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

        // if password exist, compare it with confirmation_password
        if ($request->has('password')) {
            // check if password already match with password_confirmation
            if ($request->password != $request->password_confirmation) {
                return response()->json([
                    'message' => 'Password and password confirmation does not match',
                ], 400);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Password confirmation failed',
                ], 400);
            }
        }

        if ($request->has('ktp')) {
            $path = $this->uploadToDrive($request->file('ktp'));
            $user->ktp = $path;
        }

        if ($request->has('certificate')) {
            $path = $this->uploadToDrive($request->file('certificate'));
            $user->certificate = $path;
        }

        if($request->has('full_name')) $user->full_name = $request->full_name;
        if($request->has('email')) $user->email = $request->email;
        if($request->has('email_recovery')) $user->email_recovery = $request->email_recovery;
        if($request->has('password')) $user->password = Hash::make($request->password); // Hash password
        if($request->has('role')) $user->role = $request->input('role', 'PILOT');
        if($request->has('company_name')) $user->company_name = $request->company_name;
        if($request->has('phone_number')) $user->phone_number = $request->phone_number;
        if($request->has('company_address')) $user->company_address = $request->company_address;
        if($request->has('nik')) $user->nik = $request->nik;
        if($request->has('status')) $user->status = $request->input('status', 'EXPIRED');

        $token = $user->createToken('authToken', ['*'], Carbon::now()->addHour(10));

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
            'access_token' => $token,
        ]);
}

}
