<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PortSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(VesselSeeder::class);
        $this->call(DroneSeeder::class);
        $this->call(EmissionSeeder::class);
        $this->call(EmissionResultSeeder::class);
        $this->call(PilotSeeder::class);
    }
}
