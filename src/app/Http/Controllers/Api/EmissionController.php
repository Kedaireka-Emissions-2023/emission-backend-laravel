<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Emission;
use App\Models\User;
use App\Models\Drone;
use App\Models\Vessel;
use App\Models\Port;
use App\Models\EmissionData;
use App\Models\EmissionUser;

class EmissionController extends Controller
{
    public function getAll(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $emissions = Emission::where('name', 'like', '%' . $query . '%')
            ->orWhere('checking_id', 'like', '%' . $query . '%')
            ->paginate($limit, ['*'], 'page', $page);

        if ($emissions->isEmpty()) {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }

        foreach ($emissions as $emission) {
            $emission->date = date('d F Y', strtotime($emission->date));
            $emission->unformatted_date = $emission->date;
            $emission->drone_name = Drone::find($emission->drone_id)->name;
            $emission->port_name = Port::find($emission->port_id)->name;
            $emission->vessel_name = Vessel::find($emission->vessel_id)->name;

            $emission->makeHidden([
                'drone_id',
                'vessel_id',
                'port_id',
                'pilot',
                'name',
                'preparation',
                'levels',
                'lkh_th',
                'osha_th',
                'who_th',
                'link',
                'created_at',
                'updated_at',
            ]);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $emissions
        ], 200);
    }

    public function getEmissionbyCheckingId($checkingId)
    {
        $emission = Emission::where('checking_id', $checkingId)->first();
        if ($emission) {
            $emission->date = date('d F Y', strtotime($emission->date));
            $emission->unformatted_date = $emission->date;
            $emission->drone_name = Drone::find($emission->drone_id)->name;
            $emission->port_name = Port::find($emission->port_id)->name;
            $emission->vessel_name = Vessel::find($emission->vessel_id)->name;

            if($emission->photo){
                $emission->photo = json_decode($emission->photo, true);
                $emission->photo_count = count($emission->photo);
            }

            $emission->makeHidden([
                'drone_id',
                'vessel_id',
                'port_id',
                'pilot',
                'name',
                'preparation',
                'levels',
                'lkh_th',
                'osha_th',
                'who_th',
                'link',
                'created_at',
                'updated_at',
            ]);

            return response()->json([
                'message' => 'Success',
                'data' => $emission
            ], 200);
        } else {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }
    }

    public function getEmissionbyId($id)
    {
        $emission = Emission::with('drone', 'vessel', 'port')->find($id);
        if ($emission) {
            $emission->unformatted_date = $emission->date;
            $emission->date = date('d F Y', strtotime($emission->date));
            $emission->pilot = $emission->users->pluck('full_name');
            $emission->pilot_id = $emission->users->pluck('id');

            if($emission->photo){
                $emission->photo = json_decode($emission->photo, true);
                $emission->photo_count = count($emission->photo);
            }

            return response()->json([
                'message' => 'Success',
                'data' => $emission
            ], 200);
        } else {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }
    }

    public function getFilteredEmission(Request $request)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $emissions = Emission::where('name', 'like', '%' . $query . '%')
            ->orWhere('checking_id', 'like', '%' . $query . '%')
            ->paginate($limit, ['*'], 'page', $page);

        if ($emissions->isEmpty()) {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }

        foreach ($emissions as $emission) {
            $emission->unformatted_date = $emission->date;
            $emission->date = date('d F Y', strtotime($emission->date));
            $emission->drone_name = Drone::find($emission->drone_id)->name;
            $emission->port_name = Port::find($emission->port_id)->name;
            $emission->vessel_name = Vessel::find($emission->vessel_id)->name;

            $emission->makeHidden([
                'drone_id',
                'vessel_id',
                'port_id',
                'pilot',
                'name',
                'preparation',
                'levels',
                'lkh_th',
                'osha_th',
                'who_th',
                'link',
                'created_at',
                'updated_at',
            ]);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $emissions
        ], 200);
    }

    public function countStatus(){
        $low = Emission::where('status', 'Low')->count();
        $medium = Emission::where('status', 'Medium')->count();
        $high = Emission::where('status', 'High')->count();

        return response()->json([
            'message' => 'Success',
            'data' => [
                'Low' => $low,
                'Medium' => $medium,
                'High' => $high
            ]
        ], 200);
    }

    public function getEmissionbyVesselId(Request $request, $vesselId)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $emissions = Emission::where('vessel_id', $vesselId)
        ->orWhere('name', 'like', '%' . $query . '%')
        ->paginate($limit, ['*'], 'page', $page);

        if ($emissions->isEmpty()) {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }

        foreach ($emissions as $emission) {
            $emission->unformatted_date = $emission->date;
            $emission->date = date('d F Y', strtotime($emission->date));
            $emission->drone_name = Drone::find($emission->drone_id)->name;
            $emission->port_name = Port::find($emission->port_id)->name;
            $emission->vessel_name = Vessel::find($emission->vessel_id)->name;

            $emission->makeHidden([
                'drone_id',
                'vessel_id',
                'port_id',
                'pilot',
                'name',
                'preparation',
                'levels',
                'lkh_th',
                'osha_th',
                'who_th',
                'link',
                'created_at',
                'updated_at',
            ]);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $emissions
        ], 200);
    }

    public function getEmissionbyDroneId(Request $request, $droneId)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $emissions = Emission::where('drone_id', $droneId)
        ->orWhere('name', 'like', '%' . $query . '%')
        ->paginate($limit, ['*'], 'page', $page);

        if ($emissions->isEmpty()) {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }

        foreach ($emissions as $emission) {
            $emission->unformatted_date = $emission->date;
            $emission->date = date('d F Y', strtotime($emission->date));
            $emission->drone_name = Drone::find($emission->drone_id)->name;
            $emission->port_name = Port::find($emission->port_id)->name;
            $emission->vessel_name = Vessel::find($emission->vessel_id)->name;

            $emission->makeHidden([
                'drone_id',
                'vessel_id',
                'port_id',
                'pilot',
                'name',
                'preparation',
                'levels',
                'lkh_th',
                'osha_th',
                'who_th',
                'link',
                'created_at',
                'updated_at',
            ]);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $emissions
        ], 200);
    }

    public function getEmissionbyPortId(Request $request, $portId)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $emissions = Emission::where('port_id', $portId)
        ->orWhere('name', 'like', '%' . $query . '%')
        ->paginate($limit, ['*'], 'page', $page);

        if ($emissions->isEmpty()) {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }

        foreach ($emissions as $emission) {
            $emission->unformatted_date = $emission->date;
            $emission->date = date('d F Y', strtotime($emission->date));
            $emission->drone_name = Drone::find($emission->drone_id)->name;
            $emission->port_name = Port::find($emission->port_id)->name;
            $emission->vessel_name = Vessel::find($emission->vessel_id)->name;

            $emission->makeHidden([
                'drone_id',
                'vessel_id',
                'port_id',
                'pilot',
                'name',
                'preparation',
                'levels',
                'lkh_th',
                'osha_th',
                'who_th',
                'link',
                'created_at',
                'updated_at',
            ]);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $emissions
        ], 200);
    }

    public function getEmissionbyPilotId(Request $request, $pilotId)
    {
        $page = $request->query('page');
        $limit = $request->query('limit');
        $query = $request->query('q');

        $emissions = Emission::whereHas('users', function($query) use ($pilotId) {
            $query->where('users.id', $pilotId);
        })->orWhere('name', 'like', '%' . $query . '%')
        ->paginate($limit, ['*'], 'page', $page);

        if ($emissions->isEmpty()) {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }

        foreach ($emissions as $emission) {
            $emission->unformatted_date = $emission->date;
            $emission->date = date('d F Y', strtotime($emission->date));
            $emission->drone_name = Drone::find($emission->drone_id)->name;
            $emission->port_name = Port::find($emission->port_id)->name;
            $emission->vessel_name = Vessel::find($emission->vessel_id)->name;

            $emission->makeHidden([
                'drone_id',
                'vessel_id',
                'port_id',
                'pilot',
                'name',
                'preparation',
                'levels',
                'lkh_th',
                'osha_th',
                'who_th',
                'link',
                'created_at',
                'updated_at',
            ]);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $emissions
        ], 200);
    }

    public function getTotalEmissionOnPort(Request $request, $portId)
    {
        try {
            $port = Port::where('id', $portId)->first();

            if(!$port){
                return response()->json([
                    'message' => 'Port not found',
                    'data' => null
                ], 404);
            }

            $lastEmission = Emission::where('port_id', $port->id)->orderBy('date', 'desc')->first();

            if(!$lastEmission){
                return response()->json([
                    'message' => 'No emissions found for this port',
                    'data' => null
                ], 404);
            }

            $lastEmissionData = $lastEmission->emissionData()->orderBy('date', 'desc')->first();

            if(!$lastEmissionData){
                return response()->json([
                    'message' => 'No emission data found for this port',
                    'data' => null
                ], 404);
            }

            $lastEmissionDateTime = date('d F Y, H:i', strtotime($lastEmissionData->date . ' ' . $lastEmissionData->time));

            $totalEmissionData = $lastEmission->emissionData->count();
            $totalNO2 = $lastEmission->emissionData->sum('NO2');
            $totalNO = $lastEmission->emissionData->sum('NO');
            $totalSO2 = $lastEmission->emissionData->sum('SO2');
            $totalCO2 = $lastEmission->emissionData->sum('CO2');
            $totalCO = $lastEmission->emissionData->sum('CO');
            $totalPM25 = $lastEmission->emissionData->sum('PM2_5');
            $totalPM10 = $lastEmission->emissionData->sum('PM10');

            $totalGas = $totalNO2 + $totalNO + $totalSO2 + $totalCO2 + $totalCO + $totalPM25 + $totalPM10;

            $percentageNO2 = ($totalNO2 / $totalGas) * 100;
            $percentageNO = ($totalNO / $totalGas) * 100;
            $percentageSO2 = ($totalSO2 / $totalGas) * 100;
            $percentageCO2 = ($totalCO2 / $totalGas) * 100;
            $percentageCO = ($totalCO / $totalGas) * 100;
            $percentagePM25 = ($totalPM25 / $totalGas) * 100;
            $percentagePM10 = ($totalPM10 / $totalGas) * 100;

            return response()->json([
                'message' => 'Success',
                'data' => [
                    'total_emission' => $totalEmissionData,
                    'last_emission_date' => $lastEmissionDateTime,
                    'unformatted_date' => $lastEmissionData->date,
                    'unformatted_time' => $lastEmissionData->time,
                    'total_NO2' => $totalNO2,
                    'total_NO' => $totalNO,
                    'total_SO2' => $totalSO2,
                    'total_CO2' => $totalCO2,
                    'total_CO' => $totalCO,
                    'total_PM25' => $totalPM25,
                    'total_PM10' => $totalPM10,
                    'percentage_NO2' => $percentageNO2,
                    'percentage_NO' => $percentageNO,
                    'percentage_SO2' => $percentageSO2,
                    'percentage_CO2' => $percentageCO2,
                    'percentage_CO' => $percentageCO,
                    'percentage_PM25' => $percentagePM25,
                    'percentage_PM10' => $percentagePM10,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get emission rate',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function getEDup($checkingId)
    {
        try {
            $emission = Emission::where('checking_id', $checkingId)->first();

            if(!$emission){
                return response()->json([
                    'message' => 'Emission not found',
                    'data' => null
                ], 404);
            }

            $port = Port::find($emission->port_id);
            $vessel = Vessel::find($emission->vessel_id);
            $drone = Drone::find($emission->drone_id);
            $pilots = $emission->users;

            $result = [
                'location' => 'Port ' . $port->name,
                'imo_number' => $vessel->imo_number,
                'vessel_name' => $vessel->name,
                'from' => $vessel->voyage_route_from,
                'to' => $vessel->voyage_route_to,
                'date' => date('d F Y', strtotime($emission->date)),
                'unformatted_date' => $emission->date,
                'serial_number' => $drone->serial_number,
                'drone_name' => $drone->name,
                'pilots' => $pilots->pluck('full_name'),
                'pilot_ids' => $pilots->pluck('id'),
                'status' => $emission->status,
            ];

            return response()->json([
                'message' => 'Success',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get emission detail (Up Section)',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function getEDDown($checkingId)
    {
        try {
            $emission = Emission::where('checking_id', $checkingId)->first();
            $durationApx = $emission ? $emission->duration_apx : null;

            $maxTotalDataPoints = 80;
            $emissionDataPerMinute = 1;

            if (!is_null($durationApx)) {
                $emissionDataPerMinute = ceil($maxTotalDataPoints / $durationApx);
            }

            $emissionData = EmissionData::whereHas('emission', function($query) use ($checkingId) {
                $query->where('checking_id', $checkingId);
            })->orderBy('date')->orderBy('time')->get();

            $filteredData = [];
            $seenMinutes = [];

            foreach ($emissionData as $data) {
                $dateTime = $data->date . ' ' . $data->time;
                $minute = date('Y-m-d H:i', strtotime($dateTime));

                if (!isset($seenMinutes[$minute])) {
                    $seenMinutes[$minute] = 0;
                }

                if ($seenMinutes[$minute] < $emissionDataPerMinute) {
                    $dataClone = clone $data;
                    unset($dataClone->id, $dataClone->emission_id, $dataClone->altitude, $dataClone->longitude, $dataClone->latitude);

                    $filteredData[] = $dataClone;
                    $seenMinutes[$minute]++;

                    if (count($filteredData) >= $maxTotalDataPoints + 5) {
                        break;
                    }
                }
            }

            if (count($filteredData) > $maxTotalDataPoints) {
                $filteredData = array_slice($filteredData, 0, $maxTotalDataPoints);
            }

            $totalValues = [
                'NO2' => 0,
                'NO' => 0,
                'SO2' => 0,
                'CO2' => 0,
                'CO' => 0,
                'PM2_5' => 0,
                'PM10' => 0,
            ];
            $counts = [
                'NO2' => 0,
                'NO' => 0,
                'SO2' => 0,
                'CO2' => 0,
                'CO' => 0,
                'PM2_5' => 0,
                'PM10' => 0,
            ];

            foreach ($filteredData as $data) {
                foreach ($totalValues as $key => &$total) {
                    if (!is_null($data->$key)) {
                        $total += $data->$key;
                        $counts[$key]++;
                    }
                }
            }

            $means = [];
            foreach ($totalValues as $key => $total) {
                $means[$key] = $counts[$key] > 0 ? $total / $counts[$key] : 0;
            }

            $threshold = [
                'NO2' => 10.45,
                'NO' => 9.91,
                'SO2' => 8.23,
                'CO2' => 11.01,
                'CO' => 13.95,
                'PM2_5' => 7.23,
                'PM10' => 9.45,
            ];

            $statuses = [];
            foreach ($means as $key => $mean) {
                if ($mean == 0) {
                    $statuses[$key] = 'Not checked';
                } elseif ($mean < $threshold[$key]) {
                    $statuses[$key] = 'Tolerate';
                } else {
                    $statuses[$key] = 'Not Tolerate';
                }
            }

            return response()->json([
                'message' => 'Success',
                'data' => $filteredData,
                'means' => $means,
                'threshold' => $threshold,
                'statuses' => $statuses
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get emission detail (Down Section)',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function createEmission(Request $request)
    {
        try {
            $request->validate([
                'checking_id' => 'required',
                'drone_id' => 'required|integer',
                'vessel_id' => 'required|integer',
                'port_id' => 'required|integer',
                'date' => 'required',
                'pilot' => 'required|array',
                'pilot.*' => 'required|integer',
                'photos.*' => 'file|mimes:jpg,jpeg,png|max:2048',
            ]);

            $existingEmission = Emission::where('checking_id', $request->checking_id)->first();
            if ($existingEmission) {
                return response()->json([
                    'message' => 'Failed',
                    'data' => 'Checking ID already exists.'
                ], 400);
            }

            $existingPilots = User::whereIn('id', $request->pilot)->pluck('id')->toArray();
            $requestedPilots = $request->input('pilot');
            $nonExistingPilots = array_diff($requestedPilots, $existingPilots);
            if (!empty($nonExistingPilots)) {
                return response()->json([
                    'message' => 'Failed',
                    'data' => 'One or more pilot IDs do not exist.'
                ], 400);
            }

            $photoPaths = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('photos', 'public');
                    $photoPaths[] = $path;
                }
            }

            $emission = Emission::create($request->except('pilot', 'photos'));

            $emission->users()->attach($request->pilot);

            $emission->photo = json_encode($photoPaths);

            $emission->save();

            return response()->json([
                'message' => 'Success',
                'data' => $emission
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function updateEmission(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $emission = Emission::find($request->id);
        if ($emission) {
            try {
                $photoPaths = [];
                if ($request->hasFile('photos')) {
                    $oldPhotoPaths = json_decode($emission->photo, true);
                    if (is_array($oldPhotoPaths)) {
                        foreach ($oldPhotoPaths as $oldPhoto) {
                            Storage::disk('public')->delete($oldPhoto);
                        }
                    }

                    foreach ($request->file('photos') as $photo) {
                        $path = $photo->store('photos', 'public');
                        $photoPaths[] = $path;
                    }
                } else {
                    $photoPaths = json_decode($emission->photo, true);
                }

                $emission->update($request->except('pilot', 'photos'));

                if ($request->has('pilot')) {
                    $existingPilots = User::whereIn('id', $request->pilot)->pluck('id')->toArray();
                    $requestedPilots = $request->input('pilot');
                    $nonExistingPilots = array_diff($requestedPilots, $existingPilots);

                    if (!empty($nonExistingPilots)) {
                        return response()->json([
                            'message' => 'Failed',
                            'data' => 'One or more pilot IDs do not exist.'
                        ], 400);
                    }

                    $emission->users()->sync($request->pilot);
                    $emission->pilot = $emission->users->pluck('full_name');
                }

                $emission->photo = json_encode($photoPaths);
                $emission->save();

                return response()->json([
                    'message' => 'Success',
                    'data' => $emission
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Failed update emission',
                    'data' => $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }
    }

    public function deleteEmission($id)
    {
        $emission = Emission::find($id);
        if ($emission) {
            try {
                $emission->delete();

                return response()->json([
                    'message' => 'Success',
                    'data' => null
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Failed',
                    'data' => $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'Emission not found',
                'data' => null
            ], 404);
        }
    }

    public function showPhoto($id, $photoIndex)
    {
        try {
            $emission = Emission::findOrFail($id);

            $photos = json_decode($emission->photo, true);

            if (!isset($photos[$photoIndex])) {
                return response()->json([
                    'message' => 'Failed',
                    'data' => 'Photo not found.'
                ], 404);
            }

            $photoPath = $photos[$photoIndex];

            if (!Storage::disk('public')->exists($photoPath)) {
                return response()->json([
                    'message' => 'Failed',
                    'data' => 'File not found.'
                ], 404);
            }

            return response()->file(storage_path('app/public/' . $photoPath));

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function testRelationships($emissionId)
    {
        $emission = Emission::findOrFail($emissionId);

        $port = $emission->port;

        $vessel = $emission->vessel;

        $drone = $emission->drone;

        return response()->json([
            'port' => $port,
            'vessel' => $vessel,
            'drone' => $drone,
        ]);
    }

}
