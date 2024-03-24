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
                'id' => 1,
                'full_name' => "[Test] Kedaireka BKI",
                'email' => 'bki-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'nik' => null,
                'phone_number' => null,
                'status' => 'EXPIRED',
                'role' => 'BKI'
            ]);

            User::firstOrCreate(['email' => 'pilot-test@kedaireka.id'], [
                'id' => 2,
                'full_name' => "[Test] Kedaireka Pilot",
                'email' => 'pilot-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'nik' => null,
                'phone_number' => null,
                'status' => 'EXPIRED',
                'role' => 'PILOT'
            ]);

            User::firstOrCreate(['email' => 'port-test@kedaireka.id'], [
                'id' => 3,
                'full_name' => "[Test] Kedaireka PORT",
                'email' => 'port-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'nik' => null,
                'phone_number' => null,
                'status' => 'EXPIRED',
                'role' => 'PORT'
            ]);

            User::firstOrCreate(['email' => 'ultramanpilot@kedaireka.id'], [
                'id' => 4,
                'full_name' => "[Test] Ultraman Pilot",
                'email' => "ultramanpilot@kedaireka.id",
                'nik' => null,
                'phone_number' => null,
                'status' => 'EXPIRED',
                'password' => bcrypt('Password'),
                'role' => 'PILOT'
            ]);

            User::firstOrCreate(['email' => 'madewijaya@kedaireka.id'], [
                'id' => 5,
                'full_name' => 'Made Wijaya',
                'email' => 'madewijaya@kedaireka.id',
                'nik' => '1089053116912560',
                'phone_number' => '031275415673',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'daraasri@kedaireka.id'], [
                'id' => 6,
                'full_name' => 'Dara Asri',
                'email' => 'daraasri@kedaireka.id',
                'nik' => '1667159185301370',
                'phone_number' => '081520544236',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'fabianmalik@kedaireka.id'], [
                'id' => 7,
                'full_name' => 'Fabian Malik',
                'email' => 'fabianmalik@kedaireka.id',
                'nik' => '3384794731624510',
                'phone_number' => '081545071276',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'melatisari@kedaireka.id'], [
                'id' => 8,
                'full_name' => 'Melati Sari',
                'email' => 'melatisari@kedaireka.id',
                'nik' => '3651396572274800',
                'phone_number' => '081266956693',
                'status' => 'EXPIRED',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'bayuangkasa@kedaireka.id'], [
                'id' => 9,
                'full_name' => 'Bayu Angkasa',
                'email' => 'bayuangkasa@kedaireka.id',
                'nik' => '5014694142225540',
                'phone_number' => '031694188641',
                'status' => 'EXPIRED',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'nirmaladewi@kedaireka.id'], [
                'id' => 10,
                'full_name' => 'Nirmala Dewi',
                'email' => 'nirmaladewi@kedaireka.id',
                'nik' => '5783493753319130',
                'phone_number' => '031121844895',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'satriapamungkas@kedaireka.id'], [
                'id' => 11,
                'full_name' => 'Satria Pamungkas',
                'email' => 'satriapamungkas@kedaireka.id',
                'nik' => '6929686065020820',
                'phone_number' => '081348274660',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'ayusekar@kedaireka.id'], [
                'id' => 12,
                'full_name' => 'Ayu Sekar',
                'email' => 'ayusekar@kedaireka.id',
                'nik' => '8350515650815360',
                'phone_number' => '081752183729',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'renoprasetya@kedaireka.id'], [
                'id' => 13,
                'full_name' => 'Reno Prasetya',
                'email' => 'renoprasetya@kedaireka.id',
                'nik' => '8419750578251200',
                'phone_number' => '081726652939',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);

            User::firstOrCreate(['email' => 'megaputra@kedaireka.id'], [
                'id' => 14,
                'full_name' => 'Mega Putra',
                'email' => 'megaputra@kedaireka.id',
                'nik' => '8738043136242860',
                'phone_number' => '081574014889',
                'status' => 'VALID',
                'role' => 'PILOT',
                'password' => bcrypt('Password'),
            ]);
        });
    }
}
