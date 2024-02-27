<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmissionResultSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('result_emissions')->delete();

        DB::table('result_emissions')->insert(array(
            0 =>
            array(
                'id' => 1,
                'emissions_id' => 1,
                'result' => 'Failed',
                'failure_mode' => 'L',
                'effect' => 'Drone Tenggelam',
                'cause' => 'Baterai Habis',
                'possible_action' => 'Mengganti Baterai',
                'ref_protocol' => 'Protocol 1',
            ),
            1 =>
            array(
                'id' => 2,
                'emissions_id' => 2,
                'result' => 'Success',
                'failure_mode' => 'M',
                'effect' => 'Drone Tidak Tenggelam',
                'cause' => 'Baterai Tidak Habis',
                'possible_action' => 'Mengisi Baterai',
                'ref_protocol' => 'Protocol 2',
            ),
        ));
    }
}
