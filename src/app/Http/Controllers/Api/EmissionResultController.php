<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\EmissionResult;

class EmissionResultController extends Controller
{
    public function getAllEmissionResult(Request $request)
    {
        try {
            $emissionResult = EmissionResult::all();

            return response()->json([
                'message' => 'Success',
                'data' => $emissionResult
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get emission result',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getEmissionResultById(Request $request, $id)
    {
        try {
            $emissionResult = EmissionResult::find($id);

            if ($emissionResult) {
                return response()->json([
                    'message' => 'Success',
                    'data' => $emissionResult
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Emission result not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get emission result',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getEmissionResultbyEmissionId(Request $request, $emissionId)
    {
        try {
            $page = $request->query('page');
            $limit = $request->query('limit');

            $emissionResult = EmissionResult::where('emissions_id', $emissionId)->paginate($limit, ['*'], 'page', $page);

            if ($emissionResult) {
                return response()->json([
                    'message' => 'Success',
                    'data' => $emissionResult
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Emission result not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get emission result',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download($path)
    {
        if (Storage::exists('public/' . $path)) {
            $fileContent = Storage::get('public/' . $path);

            $response = response($fileContent, 200)
                ->header('Content-Type', 'application/octet-stream')
                ->header('Content-Disposition', 'attachment; filename="' . $path . '"');

            return $response;
        } else {
            return response()->json([
                'message' => 'File not found',
                'data' => null
            ], 404);
        }
    }

    public function createEmissionResult(Request $request)
    {
        try {
            if($request->result == "Failed"){
                $emissionResult = new EmissionResult();
                $emissionResult->emissions_id = $request->emissions_id;
                $emissionResult->result = $request->result;
                $emissionResult->failure_mode = $request->failure_mode;
                $emissionResult->effect = $request->effect;
                $emissionResult->cause = $request->cause;
                $emissionResult->possible_action = $request->possible_action;
                $emissionResult->ref_protocol = $request->ref_protocol;
                $emissionResult->save();

                return response()->json([
                    'message' => 'Emission result created (Failed Verdict)',
                    'data' => $emissionResult
                ], 201);
            }else if ($request->result == "Success"){
                $emissionResult = new EmissionResult();
                $emissionResult->emissions_id = $request->emissions_id;
                $emissionResult->result = $request->result;
                if ($request->hasFile('emission_checking_file')) {
                    $emissionResult->emission_checking_file = $request->file('emission_checking_file')->store('emission-checking-file', 'public');
                }
                if ($request->hasFile('drone_video_path_file')) {
                    $emissionResult->drone_video_path_file = $request->file('drone_video_path_file')->store('drone-video-path-file', 'public');
                }
                if ($request->hasFile('drone_video_camera_file')) {
                    $emissionResult->drone_video_camera_file = $request->file('drone_video_camera_file')->store('drone-video-camera-file', 'public');
                }
                $emissionResult->save();

                return response()->json([
                    'message' => 'Emission result created (Success Verdict)',
                    'data' => $emissionResult
                ], 201);
            }else{
                return response()->json([
                    'message' => 'Emission result not created',
                    'error' => 'Invalid result'
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create emission result',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateEmissionResult(Request $request)
    {
        try {
            $emissionResult = EmissionResult::find($request->id);

            if ($emissionResult) {
                $emissionResult->emissions_id = $request->emissions_id ?? $emissionResult->emissions_id;
                $emissionResult->result = $request->result ?? $emissionResult->result;
                $emissionResult->failure_mode = $request->failure_mode ?? $emissionResult->failure_mode;
                $emissionResult->effect = $request->effect ?? $emissionResult->effect;
                $emissionResult->cause = $request->cause ?? $emissionResult->cause;
                $emissionResult->possible_action = $request->possible_action ?? $emissionResult->possible_action;
                $emissionResult->ref_protocol = $request->ref_protocol ?? $emissionResult->ref_protocol;
                $emissionResult->save();

                return response()->json([
                    'message' => 'Emission result updated',
                    'data' => $emissionResult
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Emission result not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update emission result',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteEmissionResult(Request $request, $id)
    {
        try {
            $emissionResult = EmissionResult::find($id);

            if ($emissionResult) {
                $emissionResult->delete();

                return response()->json([
                    'message' => 'Emission result deleted'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Emission result not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete emission result',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
