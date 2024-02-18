<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VesselSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vessels')->delete();

        DB::table('vessels')->insert(array (
            0 =>
            array (
                'id' => 1,
                'imo_number' => '1234567',
                'name' => 'KMP. BUKIT SIGUNTANG',
                'type' => 'Ferry',
                'status' => 'ACTIVE',
                'dwt' => 1000,
                'gt' => 1000,
                'voyage_route_from' => 'Tanjung Priok',
                'voyage_route_to' => 'Tanjung Perak',
                'vessel_speed' => 10,
                'berth' => 1,
                'draft' => 1,
                'length' => 1,
                'width' => 1,
                'main_eng' => 1,
                'main_eng_power' => 1,
                'aux_eng' => 1,
                'aux_power' => 1,
                'main_eng_fuel' => 'Pertamax',
                'aux_eng_fuel' => 'Pertamini',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
                'port_id' => '1',
            ),
            1 =>
            array (
                'id' => 2,
                'imo_number' => '1234567',
                'name' => 'KMP. BUKIT SIGUNTANG',
                'type' => 'Ferry',
                'status' => 'ACTIVE',
                'dwt' => 1000,
                'gt' => 1000,
                'voyage_route_from' => 'Tanjung Priok',
                'voyage_route_to' => 'Tanjung Perak',
                'vessel_speed' => 10,
                'berth' => 1,
                'draft' => 1,
                'length' => 1,
                'width' => 1,
                'main_eng' => 1,
                'main_eng_power' => 1,
                'aux_eng' => 1,
                'aux_power' => 1,
                'main_eng_fuel' => 'Pertamax',
                'aux_eng_fuel' => 'Pertamini',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
                'port_id' => '2',
            ),
            2 =>
            array (
                'id' => 3,
                'imo_number' => '1234567',
                'name' => 'KMP. BUKIT SIGUNTANG',
                'type' => 'Ferry',
                'status' => 'ACTIVE',
                'dwt' => 1000,
                'gt' => 1000,
                'voyage_route_from' => 'Tanjung Priok',
                'voyage_route_to' => 'Tanjung Perak',
                'vessel_speed' => 10,
                'berth' => 1,
                'draft' => 1,
                'length' => 1,
                'width' => 1,
                'main_eng' => 1,
                'main_eng_power' => 1,
                'aux_eng' => 1,
                'aux_power' => 1,
                'main_eng_fuel' => 'Pertamax',
                'aux_eng_fuel' => 'Pertamini',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
                'port_id' => '3',
            ),
            3 =>
            array (
                'id' => 4,
                'imo_number' => '1234567',
                'name' => 'KMP. BUKIT SIGUNTANG',
                'type' => 'Ferry',
                'status' => 'ACTIVE',
                'dwt' => 1000,
                'gt' => 1000,
                'voyage_route_from' => 'Tanjung Priok',
                'voyage_route_to' => 'Tanjung Perak',
                'vessel_speed' => 10,
                'berth' => 1,
                'draft' => 1,
                'length' => 1,
                'width' => 1,
                'main_eng' => 1,
                'main_eng_power' => 1,
                'aux_eng' => 1,
                'aux_power' => 1,
                'main_eng_fuel' => 'Pertamax',
                'aux_eng_fuel' => 'Pertamini',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
                'port_id' => '4',
            ),
        ));
    }
}
