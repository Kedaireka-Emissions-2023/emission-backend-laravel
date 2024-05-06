<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmissionUser;

class EmissionUserController extends Controller
{
    public function setSniffingPilot(Request $request)
    {
        $request->validate([
            'emission_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $emissionUser = EmissionUser::create($request->all());

        return response()->json([
            'message' => 'Success',
            'data' => $emissionUser
        ], 200);
    }
}
