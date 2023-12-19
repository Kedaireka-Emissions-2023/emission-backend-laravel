<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

use App\Models\Drone;

class DroneController extends Controller
{
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

    private function uploadToDrive($image)
    {
        $path = $image->store('public/images');
        $imageUrl = Storage::path($path);

        Gdrive::put($imageUrl, $image);

        //delete storage
        Storage::delete($path);
        return $path;
    }

    public function get_test($id)
    {
        $drone = Drone::find($id);
        if ($drone) {
            $filePath = "/Users/t-okyan.ramadhana/KEDAIREKA/emission-backend-laravel/src/storage/app/" . $drone->cert_insurance_doc;
            $data = Gdrive::get($filePath);
            return response($data->file, 200)->header('Content-Type', $data->ext);
        } else {
            return response()->json([
                'message' => 'Drone not found',
                'data' => null
            ], 404);
        }
    }

    public function getAll(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');

        $drones = Drone::paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'message' => 'Success',
            'data' => $drones
        ], 200);
    }

    public function getDronebyId($id)
    {
        $drone = Drone::find($id);
        if ($drone) {
            return response()->json([
                'message' => 'Success',
                'data' => $drone
            ], 200);
        } else {
            return response()->json([
                'message' => 'Drone not found',
                'data' => null
            ], 404);
        }
    }

    public function createDrone(Request $request)
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

        if($request->hasFile('cert_emergency_procedure'))
            $cert_emergency_procedure = $this->uploadToDrive($request->file('cert_emergency_procedure'));
        else
            $cert_emergency_procedure = null;

        if($request->hasFile('cert_insurance_doc'))
            $cert_insurance_doc = $this->uploadToDrive($request->file('cert_insurance_doc'));
        else
            $cert_insurance_doc = null;

        if($request->hasFile('cert_equipment_list'))
            $cert_equipment_list = $this->uploadToDrive($request->file('cert_equipment_list'));
        else
            $cert_equipment_list = null;

        if($request->hasFile('cert_drone_photo'))
            $cert_drone_photo = $this->uploadToDrive($request->file('cert_drone_photo'));
        else
            $cert_drone_photo = null;

        if($request->hasFile('cert_drone_certificate'))
            $cert_drone_certificate = $this->uploadToDrive($request->file('cert_drone_certificate'));
        else
            $cert_drone_certificate = null;

        $drone = new Drone();
        $drone->name = $request->name;
        $drone->serial_number = $request->serial_number;
        $drone->weight_no_payload = $request->weight_no_payload;
        $drone->cruise_speed = $request->cruise_speed;
        $drone->climb_max_rate = $request->climb_max_rate;
        $drone->volume_payload_size = $request->volume_payload_size;
        $drone->wing_material = $request->wing_material;
        $drone->fuselage_material = $request->fuselage_material;
        $drone->filesave_system = $request->filesave_system;
        $drone->control_system = $request->control_system;
        $drone->max_takeoff_weight = $request->max_takeoff_weight;
        $drone->max_flight_range = $request->max_flight_range;
        $drone->max_speed = $request->max_speed;
        $drone->max_cruise_height = $request->max_cruise_height;
        $drone->operational_payload_weight = $request->operational_payload_weight;
        $drone->proximity_sensor = $request->proximity_sensor;
        $drone->precision_landinig_mechanism = $request->precision_landinig_mechanism;
        $drone->operation_system = $request->operation_system;
        $drone->communication_system = $request->communication_system;
        $drone->description = $request->description;
        $drone->cert_emergency_procedure = $cert_emergency_procedure;
        $drone->cert_insurance_doc = $cert_insurance_doc;
        $drone->cert_equipment_list = $cert_equipment_list;
        $drone->cert_drone_photo = $cert_drone_photo;
        $drone->cert_drone_certificate = $cert_drone_certificate;
        $drone->expiration_date = $request->expiration_date;
        $drone->save();

        return response()->json([
            'message' => 'Success',
            'data' => $drone
        ], 201);
    }

    public function updateDrone(Request $request, $id)
    {
        $drone = Drone::find($id);
        if ($drone) {
            $drone->update($request->all());
            return response()->json([
                'message' => 'Success',
                'data' => $drone
            ], 200);
        } else {
            return response()->json([
                'message' => 'Drone not found',
                'data' => null
            ], 404);
        }
    }

    public function deleteDrone($id)
    {
        $drone = Drone::find($id);
        if ($drone) {
            $drone->delete();
            return response()->json([
                'message' => 'Drone deleted',
                'data' => $drone
            ], 200);
        } else {
            return response()->json([
                'message' => 'Drone not found',
                'data' => null
            ], 404);
        }
    }
}
