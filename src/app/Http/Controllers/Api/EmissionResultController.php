<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmissionResult;

class EmissionResultController extends Controller
{
    public function getAllEmissionResult(Request $request)
    {
        // Use try catch to catch any exception
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

    public function createEmissionResult(Request $request)
    {
        try {
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
                'message' => 'Emission result created',
                'data' => $emissionResult
            ], 201);
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
                // Only update the field that is present in the request
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
