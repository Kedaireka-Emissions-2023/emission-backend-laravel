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

use Yaza\LaravelGoogleDriveStorage\Gdrive;

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

use App\Models\User;
use App\Models\Port;
use App\Models\Emission;

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
        $query = $request->query('q');

        // $pilots = User::where('role', 'PILOT')->paginate($limit, ['*'], 'page', $page);
        $pilots = User::where('role', 'PILOT')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('full_name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('company_name', 'like', '%' . $query . '%');
            })
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'message' => 'Success',
            'data' => $pilots
        ], 200);
    }

    public function getTotalPilotOnPort($portId)
    {
        try {
            $port = Port::where('port_id', $portId)->first();

            if (!$port) {
                return response()->json([
                    'message' => 'Port not found',
                    'data' => null
                ], 404);
            }

            $emissions = Emission::where('port_id', $port->id)->get();

            $distinctPilots = [];

            foreach ($emissions as $emission) {
                $pilotData = $emission->get('pilot');
                dd($pilotData);
                if (is_string($pilotData)) {
                    $pilots = json_decode($pilotData, true);
                    if (is_array($pilots)) {
                        foreach ($pilots as $pilot) {
                            $name = $pilot['name'];
                            if (!in_array($name, $distinctPilots)) {
                                $distinctPilots[] = $name;
                            }
                        }
                    }
                } elseif (is_object($pilotData) && $pilotData instanceof \Spatie\SchemalessAttributes\SchemalessAttributes) {
                    $pilotArray = $pilotData->toArray();
                    foreach ($pilotArray as $pilot) {
                        $name = $pilot['name'];
                        if (!in_array($name, $distinctPilots)) {
                            $distinctPilots[] = $name;
                        }
                    }
                }
            }

            $pilotCounts = count($distinctPilots);

            return response()->json([
                'message' => 'Success',
                'data' => [
                    'Pilots with emission' => $pilotCounts
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error getting total pilot',
                'data' => $e->getMessage()
            ], 400);
        }
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
            // New password-related fields are present, but old password is missing
            return response()->json([
                'message' => 'Old Password is required when updating the password',
            ], 400);
        } elseif ($request->has('old_password')) {
            // Old password is present, but new password-related fields are missing
            return response()->json([
                'message' => 'New Password and Confirmation Password are required when updating the password',
            ], 400);
        }

        if ($request->has('ktp')) {
            $temp = $request->file('ktp');
            $res = $this->uploadImage($temp);
            $user->ktp = $res['secure_url'];
        }

        if ($request->has('certificate')) {
            $temp = $request->file('certificate');
            $res = $this->uploadImage($temp);
            $user->certificate = $res['secure_url'];
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

    private function uploadImage($image)
    {
        $path = $image->store('public/images');
        $imageUrl = Storage::path($path);

        $my_key = env('CLOUDINARY_API_KEY');
        $my_secret = env('CLOUDINARY_API_SECRET');
        $my_cloud = env('CLOUDINARY_CLOUD_NAME');
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $my_cloud,
                'api_key' => $my_key,
                'api_secret' => $my_secret
            ]
        ]);

        $uploadApi = new UploadApi();
        $result = $uploadApi->upload($imageUrl, ['resource_type' => 'auto']);

        //delete storage
        Storage::delete($path);
        return $result;
    }
}
