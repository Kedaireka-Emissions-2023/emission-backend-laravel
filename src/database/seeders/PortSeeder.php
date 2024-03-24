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
                'port_id' => 'BLW',
                'name' => 'Belawan',
                'operator_address' => 'JL. Suar No. 1 Pelabuhan Belawan Medan, Sumut - 20411',
                'office_address' => 'JL. Suar No. 1 Pelabuhan Belawan Medan, Sumut - 20411',
                'city' => 'Kota Medan',
                'phone_number' => '0616941919',
            ),
            1 =>
            array (
                'id' => 2,
                'port_id' => 'MAK',
                'name' => 'Makassar',
                'operator_address' => 'Jl. Madura No. 1 Makasar - 90173',
                'office_address' => 'Jl. Madura No. 1 Makasar - 90173',
                'city' => 'Kota Makassar',
                'phone_number' => '04113616444',
            ),
            2 =>
            array (
                'id' => 3,
                'port_id' => 'SRG',
                'name' => 'Tanjung Emas',
                'operator_address' => 'KSOP KELAS I TANJUNG EMAS SEMARANG Jl. Yos Sudarso No. 30 Kel. Tanjung Emas Kec. Semarang Jateng 50174',
                'office_address' => 'Jl. Yos Sudarso No. 30 Kel. Tanjung Emas Kec. Semarang Jateng 50174',
                'city' => 'Semarang',
                'phone_number' => '0243852335',
            ),
            3 =>
            array (
                'id' => 4,
                'port_id' => 'SUB',
                'name' => 'Tanjung Perak',
                'operator_address' => 'KANTOR SYAHBANDAR UTAMA TANJUNG PERAK SURABAYA Jl. Kalimas Baru No. 194 Surabaya Jawa Timur 60165',
                'office_address' => 'Jl. Kalimas Baru No. 194 Surabaya Jawa Timur 60165',
                'city' => 'Kota Surabaya',
                'phone_number' => '0313291479',
            ),
            4 =>
            array (
                'id' => 5,
                'port_id' => 'TPR',
                'name' => 'Tanjung Priok',
                'operator_address' => 'KANTOR SYAHBANDAR UTAMA TANJUNG PRIOK Jl. Padamarang No. 4 Tanjung Priok Jakarta Utara 14310',
                'office_address' => 'Jl. Padamarang No. 4 Tanjung Priok Jakarta Utara 14310',
                'city' => 'Jakarta Utara',
                'phone_number' => '077121513',
            ),
        ));
    }
}
