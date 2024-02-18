<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ports')->delete();

        DB::table('ports')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Port of Tanjung Priok',
                'operator_address' => 'Jl. Raya Pelabuhan No.9, Tanjung Priok, Kec. Tj. Priok, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14310',
                'office_address' => 'Jl. Raya Pelabuhan No.9, Tanjung Priok, Kec. Tj. Priok, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14310',
                'longitude' => '106.86667',
                'latitude' => '-6.13333',
                'city' => 'Jakarta',
                'phone_number' => '021 43930555',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Port of Tanjung Perak',
                'operator_address' => 'Jl. Perak Tim. No.1, Perak Tim., Kec. Pabean Cantikan, Kota SBY, Jawa Timur 60165',
                'office_address' => 'Jl. Perak Tim. No.1, Perak Tim., Kec. Pabean Cantikan, Kota SBY, Jawa Timur 60165',
                'longitude' => '112.73333',
                'latitude' => '-7.23333',
                'city' => 'Surabaya',
                'phone_number' => '031 3293090',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Port of Belawan',
                'operator_address' => 'Jl. Pelabuhan No.1, Belawan I, Kec. Medan Belawan, Kota Medan, Sumatera Utara 20411',
                'office_address' => 'Jl. Pelabuhan No.1, Belawan I, Kec. Medan Belawan, Kota Medan, Sumatera Utara 20411',
                'longitude' => '98.68333',
                'latitude' => '3.78333',
                'city' => 'Medan',
                'phone_number' => '061 6941111',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Port of Tanjung Emas',
                'operator_address' => 'Jl. Pelabuhan No.1, Tanjung Emas, Kec. Tawangsari, Kota Semarang, Jawa Tengah 50174',
                'office_address' => 'Jl. Pelabuhan No.1, Tanjung Emas, Kec. Tawangsari, Kota Semarang, Jawa Tengah 50174',
                'longitude' => '110.41667',
                'latitude' => '-6.98333',
                'city' => 'Semarang',
                'phone_number' => '024 7611000',
            ),
        ));
    }
}
