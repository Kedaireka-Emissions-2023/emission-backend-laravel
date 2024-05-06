<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            User::firstOrCreate(['email' => 'bki-test@kedaireka.id'], [
                'full_name' => "[Test] Kedaireka BKI",
                'email' => 'bki-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'nik' => null,
                'phone_number' => null,
                'status' => 'EXPIRED',
                'role' => 'BKI',
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'pilot-test@kedaireka.id'], [
                'full_name' => "[Test] Kedaireka Pilot",
                'email' => 'pilot-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'nik' => null,
                'phone_number' => null,
                'status' => 'EXPIRED',
                'role' => 'PILOT',
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'port-test@kedaireka.id'], [
                'full_name' => "[Test] Kedaireka PORT",
                'email' => 'port-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'nik' => null,
                'phone_number' => null,
                'status' => 'EXPIRED',
                'role' => 'PORT',
                'port_id' => 1
            ]);

            User::firstOrCreate(['email' => 'ultramanpilot@kedaireka.id'], [
                'full_name' => "[Test] Ultraman Pilot",
                'email' => "ultramanpilot@kedaireka.id",
                'nik' => null,
                'phone_number' => null,
                'status' => 'EXPIRED',
                'password' => bcrypt('Password'),
                'role' => 'PILOT',
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'madewijaya@kedaireka.id'], [
                'full_name' => 'Made Wijaya',
                'email' => 'madewijaya@kedaireka.id',
                'nik' => '1089053116912560',
                'phone_number' => '031275415673',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'daraasri@kedaireka.id'], [
                'full_name' => 'Dara Asri',
                'email' => 'daraasri@kedaireka.id',
                'nik' => '1667159185301370',
                'phone_number' => '081520544236',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'fabianmalik@kedaireka.id'], [
                'full_name' => 'Fabian Malik',
                'email' => 'fabianmalik@kedaireka.id',
                'nik' => '3384794731624510',
                'phone_number' => '081545071276',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'melatisari@kedaireka.id'], [
                'full_name' => 'Melati Sari',
                'email' => 'melatisari@kedaireka.id',
                'nik' => '3651396572274800',
                'phone_number' => '081266956693',
                'status' => 'EXPIRED',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'bayuangkasa@kedaireka.id'], [
                'full_name' => 'Bayu Angkasa',
                'email' => 'bayuangkasa@kedaireka.id',
                'nik' => '5014694142225540',
                'phone_number' => '031694188641',
                'status' => 'EXPIRED',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'nirmaladewi@kedaireka.id'], [
                'full_name' => 'Nirmala Dewi',
                'email' => 'nirmaladewi@kedaireka.id',
                'nik' => '5783493753319130',
                'phone_number' => '031121844895',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'satriapamungkas@kedaireka.id'], [
                'full_name' => 'Satria Pamungkas',
                'email' => 'satriapamungkas@kedaireka.id',
                'nik' => '6929686065020820',
                'phone_number' => '081348274660',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'ayusekar@kedaireka.id'], [
                'full_name' => 'Ayu Sekar',
                'email' => 'ayusekar@kedaireka.id',
                'nik' => '8350515650815360',
                'phone_number' => '081752183729',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'renoprasetya@kedaireka.id'], [
                'full_name' => 'Reno Prasetya',
                'email' => 'renoprasetya@kedaireka.id',
                'nik' => '8419750578251200',
                'phone_number' => '081726652939',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);

            User::firstOrCreate(['email' => 'megaputra@kedaireka.id'], [
                'full_name' => 'Mega Putra',
                'email' => 'megaputra@kedaireka.id',
                'nik' => '8738043136242860',
                'phone_number' => '081574014889',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
                'port_id' => null
            ]);
        });
    }
}
