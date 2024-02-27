<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('emissions')->delete();

        DB::table('emissions')->insert(array(
            0 =>
            array(
                'id' => 1,
                'drone_id' => 1,
                'vessel_id' => 1,
                'port_id' => 1,
                'name' => '[Test] Emission 1',
                'levels' => 0.1,
                'lkh_th' => 0.1,
                'osha_th' => 0.1,
                'who_th' => 0.1,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            1 =>
            array(
                'id' => 2,
                'drone_id' => 1,
                'vessel_id' => 1,
                'port_id' => 1,
                'name' => '[Test] Emission 2',
                'levels' => 0.2,
                'lkh_th' => 0.2,
                'osha_th' => 0.2,
                'who_th' => 0.2,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            2 =>
            array(
                'id' => 3,
                'drone_id' => 1,
                'vessel_id' => 1,
                'port_id' => 1,
                'name' => '[Test] Emission 3',
                'levels' => 0.3,
                'lkh_th' => 0.3,
                'osha_th' => 0.3,
                'who_th' => 0.3,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            3 =>
            array(
                'id' => 4,
                'drone_id' => 1,
                'vessel_id' => 1,
                'port_id' => 1,
                'name' => '[Test] Emission 4',
                'levels' => 0.4,
                'lkh_th' => 0.4,
                'osha_th' => 0.4,
                'who_th' => 0.4,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            4 =>
            array(
                'id' => 5,
                'drone_id' => 1,
                'vessel_id' => 1,
                'port_id' => 1,
                'name' => '[Test] Emission 5',
                'levels' => 0.5,
                'lkh_th' => 0.5,
                'osha_th' => 0.5,
                'who_th' => 0.5,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
        ));
    }
}
