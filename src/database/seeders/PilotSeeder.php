<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Emission;
use App\Models\EmissionUser;

class PilotSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('emission_user')->delete();

        DB::transaction(function () {
            EmissionUser::create([
                'emission_id' => 1,
                'user_id' => 2,
            ]);
            EmissionUser::create([
                'emission_id' => 2,
                'user_id' => 2,
            ]);
            EmissionUser::create([
                'emission_id' => 3,
                'user_id' => 2,
            ]);
        });
    }
}
