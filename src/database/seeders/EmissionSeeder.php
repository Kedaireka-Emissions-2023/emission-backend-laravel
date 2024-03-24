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
                'status' => 'MEDIUM',
                'pilot' => '[{"name":"Made Wijaya"},{"name":"Dara Asri"}]',
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
                'status' => 'LOW',
                'pilot' => '[{"name":"Dara Asri"},{"name":"Made Wijaya"}]',
            ),
            2 =>
            array(
                'id' => 3,
                'drone_id' => 1,
                'vessel_id' => 7,
                'port_id' => 1,
                'checking_id' => 'EBLW003',
                'date' => '2024-03-01',
                'time' => '15:37',
                'status' => 'LOW',
                'pilot' => '[{"name":"Made Wijaya"},{"name":"Dara Asri"}]',
            ),
            3 =>
            array(
                'id' => 4,
                'drone_id' => 2,
                'vessel_id' => 8,
                'port_id' => 1,
                'checking_id' => 'EBLW004',
                'date' => '2024-03-09',
                'time' => '09:19',
                'status' => 'HIGH',
                'pilot' => '[{"name":"Dara Asri"},{"name":"Made Wijaya"}]',
            ),
            4 =>
            array(
                'id' => 5,
                'drone_id' => 1,
                'vessel_id' => 8,
                'port_id' => 1,
                'checking_id' => 'EBLW005',
                'date' => '2024-03-11',
                'time' => '16:23',
                'status' => 'HIGH',
                'pilot' => '[{"name":"Made Wijaya"},{"name":"Dara Asri"}]',
            ),
            5 =>
            array(
                'id' => 6,
                'drone_id' => 3,
                'vessel_id' => 2,
                'port_id' => 2,
                'checking_id' => 'EMAK001',
                'date' => '2024-03-05',
                'time' => '09:46',
                'status' => 'MEDIUM',
                'pilot' => '[{"name":"Fabian Malik"},{"name":"Melati Sari"}]',
            ),
            6 =>
            array(
                'id' => 7,
                'drone_id' => 3,
                'vessel_id' => 5,
                'port_id' => 2,
                'checking_id' => 'EMAK002',
                'date' => '2024-03-01',
                'time' => '13:24',
                'status' => 'LOW',
                'pilot' => '[{"name":"Melati Sari"},{"name":"Fabian Malik"}]',
            ),
            7 =>
            array(
                'id' => 8,
                'drone_id' => 3,
                'vessel_id' => 6,
                'port_id' => 2,
                'checking_id' => 'EMAK003',
                'date' => '2024-03-23',
                'time' => '16:15',
                'status' => 'MEDIUM',
                'pilot' => '[{"name":"Fabian Malik"},{"name":"Melati Sari"}]',
            ),
            8 =>
            array(
                'id' => 9,
                'drone_id' => 4,
                'vessel_id' => 7,
                'port_id' => 2,
                'checking_id' => 'EMAK004',
                'date' => '2024-03-10',
                'time' => '11:55',
                'status' => 'PROCESS',
                'pilot' => '[]',
            ),
            9 =>
            array(
                'id' => 10,
                'drone_id' => 3,
                'vessel_id' => 5,
                'port_id' => 2,
                'checking_id' => 'EMAK005',
                'date' => '2024-03-08',
                'time' => '13:24',
                'status' => 'MEDIUM',
                'pilot' => '[{"name":"Fabian Malik"},{"name":"Melati Sari"}]',
            ),
            10 =>
            array(
                'id' => 11,
                'drone_id' => 5,
                'vessel_id' => 3,
                'port_id' => 3,
                'checking_id' => 'ESRG001',
                'date' => '2024-03-02',
                'time' => '10:00',
                'status' => 'HIGH',
                'pilot' => '[{"name":"Bayu Angkasa"}]',
            ),
            11 =>
            array(
                'id' => 12,
                'drone_id' => 6,
                'vessel_id' => 4,
                'port_id' => 3,
                'checking_id' => 'ESRG002',
                'date' => '2024-03-04',
                'time' => '07:00',
                'status' => 'MEDIUM',
                'pilot' => '[{"name":"Nirmala Dewi"},{"name":"Bayu Angkasa"}]',
            ),
            12 =>
            array(
                'id' => 13,
                'drone_id' => 5,
                'vessel_id' => 8,
                'port_id' => 3,
                'checking_id' => 'ESRG003',
                'date' => '2024-03-14',
                'time' => '12:06',
                'status' => 'HIGH',
                'pilot' => '[{"name":"Bayu Angkasa"}]',
            ),
            13 =>
            array(
                'id' => 14,
                'drone_id' => 6,
                'vessel_id' => 3,
                'port_id' => 3,
                'checking_id' => 'ESRG004',
                'date' => '2024-03-07',
                'time' => '10:00',
                'status' => 'HIGH',
                'pilot' => '[{"name":"Nirmala Dewi"}]',
            ),
            14 =>
            array(
                'id' => 15,
                'drone_id' => 6,
                'vessel_id' => 4,
                'port_id' => 3,
                'checking_id' => 'ESRG005',
                'date' => '2024-03-08',
                'time' => '07:00',
                'status' => 'MEDIUM',
                'pilot' => '[{"name":"Nirmala Dewi"}]',
            ),
            15 =>
            array(
                'id' => 16,
                'drone_id' => 7,
                'vessel_id' => 1,
                'port_id' => 2,
                'checking_id' => 'ESUB001',
                'date' => '2024-03-17',
                'time' => '13:58',
                'status' => 'LOW',
                'pilot' => '[{"name":"Satria Pamungkas"},{"name":"Ayu Sekar"}]',
            ),
            16 =>
            array(
                'id' => 17,
                'drone_id' => 8,
                'vessel_id' => 2,
                'port_id' => 2,
                'checking_id' => 'ESUB002',
                'date' => '2024-03-12',
                'time' => '10:00',
                'status' => 'HIGH',
                'pilot' => '[{"name":"Ayu Sekar"},{"name":"Satria Pamungkas"}]',
            ),
            17 =>
            array(
                'id' => 18,
                'drone_id' => 8,
                'vessel_id' => 4,
                'port_id' => 2,
                'checking_id' => 'ESUB003',
                'date' => '2024-03-12',
                'time' => '14:00',
                'status' => 'LOW',
                'pilot' => '[{"name":"Satria Pamungkas"},{"name":"Ayu Sekar"}]',
            ),
            18 =>
            array(
                'id' => 19,
                'drone_id' => 8,
                'vessel_id' => 1,
                'port_id' => 2,
                'checking_id' => 'ESUB004',
                'date' => '2024-03-25',
                'time' => '13:58',
                'status' => 'MEDIUM',
                'pilot' => '[{"name":"Ayu Sekar"},{"name":"Satria Pamungkas"}]',
            ),
            19 =>
            array(
                'id' => 20,
                'drone_id' => 8,
                'vessel_id' => 4,
                'port_id' => 2,
                'checking_id' => 'ESUB005',
                'date' => '2024-03-28',
                'time' => '14:00',
                'status' => 'PROCESS',
                'pilot' => '[]',
            ),
            20 =>
            array(
                'id' => 21,
                'drone_id' => 9,
                'vessel_id' => 1,
                'port_id' => 3,
                'checking_id' => 'ETPR001',
                'date' => '2024-03-20',
                'time' => '08:11',
                'status' => 'LOW',
                'pilot' => '[{"name":"Reno Prasetya"}]',
            ),
            21 =>
            array(
                'id' => 22,
                'drone_id' => 9,
                'vessel_id' => 2,
                'port_id' => 3,
                'checking_id' => 'ETPR002',
                'date' => '2024-03-15',
                'time' => '18:05',
                'status' => 'LOW',
                'pilot' => '[{"name":"Mega Putra"},{"name":"Reno Prasetya"}]',
            ),
            22 =>
            array(
                'id' => 23,
                'drone_id' => 9,
                'vessel_id' => 1,
                'port_id' => 3,
                'checking_id' => 'ETPR003',
                'date' => '2024-03-27',
                'time' => '08:54',
                'status' => 'LOW',
                'pilot' => '[{"name":"Mega Putra"}]',
            ),
            23 =>
            array(
                'id' => 24,
                'drone_id' => 10,
                'vessel_id' => 2,
                'port_id' => 3,
                'checking_id' => 'ETPR004',
                'date' => '2024-03-22',
                'time' => '18:05',
                'status' => 'PROCESS',
                'pilot' => '[]',
            ),
            24 =>
            array(
                'id' => 25,
                'drone_id' => 10,
                'vessel_id' => 1,
                'port_id' => 3,
                'checking_id' => 'ETPR005',
                'date' => '2024-04-06',
                'time' => '08:01',
                'status' => 'PROCESS',
                'pilot' => '[]',
            ),
        ));
    }
}
