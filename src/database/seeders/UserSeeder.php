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

        DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'full_name' => "Kedaireka BKI",
                'email' => 'bki@kedaireka.com',
                'password' => bcrypt('Password'),
                'role' => 'BKI'
            ),
            1 =>
            array (
                'id' => 2,
                'full_name' => "Kedaireka Pilot",
                'email' => 'pilot@kedaireka.com',
                'password' => bcrypt('Password'),
                'role' => 'PILOT'
            ),
            2 =>
            array (
                'id' => 3,
                'full_name' => "Kedaireka PORT",
                'email' => 'port@kedaireka.com',
                'password' => bcrypt('Password'),
                'role' => 'PORT'
            ),
        ));
    }
}
