<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'full_name' => "Kedaireka BKI",
            'email' => 'bki@kedaireka.com',
            'password' => bcrypt('Password'),
            'role' => 'BKI'
        ]);

        User::create([
            'full_name' => "Kedaireka Pilot",
            'email' => 'pilot@kedaireka.com',
            'password' => bcrypt('Password'),
            'role' => 'PILOT'
        ]);

        User::create([
            'full_name' => "Kedaireka PORT",
            'email' => 'port@kedaireka.com',
            'password' => bcrypt('Password'),
            'role' => 'PORT'
        ]);
    }
}
