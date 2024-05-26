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
                'vessel_id' => 6,
                'port_id' => 1,
                'checking_id' => 'EBLW001',
                'date' => '2024-03-03',
                'time' => '16:15',
                'status' => 'MEDIUM'
            ),
            1 =>
            array(
                'id' => 2,
                'drone_id' => 2,
                'vessel_id' => 1,
                'port_id' => 1,
                'checking_id' => 'EBLW002',
                'date' => '2024-03-13',
                'time' => '13:21',
                'status' => 'LOW'
            ),
            2 =>
            array(
                'id' => 3,
                'drone_id' => 3,
                'vessel_id' => 5,
                'port_id' => 2,
                'checking_id' => 'EMAK002',
                'date' => '2024-03-01',
                'time' => '13:24',
                'status' => 'LOW'
            ),
            3 =>
            array(
                'id' => 4,
                'drone_id' => 3,
                'vessel_id' => 6,
                'port_id' => 2,
                'checking_id' => 'EMAK003',
                'date' => '2024-03-23',
                'time' => '16:15',
                'status' => 'MEDIUM'
            ),
            4 =>
            array(
                'id' => 5,
                'drone_id' => 5,
                'vessel_id' => 3,
                'port_id' => 3,
                'checking_id' => 'ESRG001',
                'date' => '2024-03-02',
                'time' => '10:00',
                'status' => 'HIGH'
            ),
            5 =>
            array(
                'id' => 6,
                'drone_id' => 6,
                'vessel_id' => 4,
                'port_id' => 3,
                'checking_id' => 'ESRG002',
                'date' => '2024-03-04',
                'time' => '07:00',
                'status' => 'MEDIUM'
            ),
            6 =>
            array(
                'id' => 7,
                'drone_id' => 7,
                'vessel_id' => 1,
                'port_id' => 2,
                'checking_id' => 'ESUB001',
                'date' => '2024-03-17',
                'time' => '13:58',
                'status' => 'LOW'
            ),
            7 =>
            array(
                'id' => 8,
                'drone_id' => 9,
                'vessel_id' => 1,
                'port_id' => 3,
                'checking_id' => 'ETPR001',
                'date' => '2024-03-20',
                'time' => '08:11',
                'status' => 'LOW'
            ),
            8 =>
            array(
                'id' => 9,
                'drone_id' => 9,
                'vessel_id' => 2,
                'port_id' => 3,
                'checking_id' => 'ETPR002',
                'date' => '2024-03-15',
                'time' => '18:05',
                'status' => 'LOW'
            ),
            9 =>
            array(
                'id' => 10,
                'drone_id' => 9,
                'vessel_id' => 1,
                'port_id' => 3,
                'checking_id' => 'ETPR003',
                'date' => '2024-03-27',
                'time' => '08:54',
                'status' => 'LOW'
            ),
        ));
    }
}
