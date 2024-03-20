<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'full_name' => "[Test] Kedaireka BKI",
                'email' => 'bki-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'role' => 'BKI'
            ),
            1 =>
            array(
                'id' => 2,
                'full_name' => "[Test] Kedaireka Pilot",
                'email' => 'pilot-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'role' => 'PILOT'
            ),
            2 =>
            array(
                'id' => 3,
                'full_name' => "[Test] Kedaireka PORT",
                'email' => 'port-test@kedaireka.id',
                'password' => bcrypt('Password'),
                'role' => 'PORT'
            ),
            3 =>
            array(
                'id' => 4,
                'full_name' => "[Test] Ultraman Pilot",
                'email' => "ultramanpilot@kedaireka.com",
                'password' => bcrypt('Password'),
                'role' => 'PILOT'
            ),
        ));
    }
}
