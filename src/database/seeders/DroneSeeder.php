<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DroneSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('drones')->delete();

        DB::table('drones')->insert(array(
            0 =>
            array (
                'id' => 1,
                'serial_number' => 'DBLW01',
                'name' => 'AeroScan',
                'weight_no_payload' => 10,
                'cruise_speed' => 20,
                'climb_max_rate' => 8,
                'volume_payload_size' => '50x50x10',
                'wing_material' => 'Carbon Fiber',
                'fuselage_material' => 'Carbon Fiber',
                'filesave_system' => 'SSD',
                'control_system' => 'GPS + Gyro',
                'max_takeoff_weight' => 25,
                'max_flight_range' => 50,
                'max_speed' => 30,
                'max_cruise_height' => 2000,
                'operational_payload_weight' => 5,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Laser + Camera',
                'operation_system' => 'Linux',
                'communication_system' => 'LTE + Satellite',
                'description' => 'High-precision drone for detailed emissions scan',
            ),
            1 =>
            array (
                'id' => 2,
                'serial_number' => 'DBLW02',
                'name' => 'SkyGuardian',
                'weight_no_payload' => 15,
                'cruise_speed' => 25,
                'climb_max_rate' => 10,
                'volume_payload_size' => '60x60x10',
                'wing_material' => 'Aluminum Alloy',
                'fuselage_material' => 'Aluminum Alloy',
                'filesave_system' => 'HDD',
                'control_system' => 'GPS + Inertial',
                'max_takeoff_weight' => '30',
                'max_flight_range' => 75,
                'max_speed' => 35,
                'max_cruise_height' => 2500,
                'operational_payload_weight' => 8,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Camera + Ultrasonic',
                'operation_system' => 'Windows',
                'communication_system' => '4G + Satelite',
                'description' => 'Robust drone with extended flight capabilities',
            ),
            2 =>
            array(
                'id' => 3,
                'serial_number' => 'DMAK01',
                'name' => 'EcoDrone Pro',
                'weight_no_payload' => 8,
                'cruise_speed' => 18,
                'climb_max_rate' => 6,
                'volume_payload_size' => '70x70x10',
                'wing_material' => 'Composite',
                'fuselage_material' => 'Composite',
                'filesave_system' => 'SSD',
                'control_system' => 'GPS + Gyro',
                'max_takeoff_weight' => 20,
                'max_flight_range' => 40,
                'max_speed' => 25,
                'max_cruise_height' => 1800,
                'operational_payload_weight' => 3,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Laser + Camera',
                'operation_system' => 'Linux',
                'communication_system' => '4G + Wi-Fi',
                'description' => 'Environment-friendly drone with precise sensors',
            ),
            3 =>
            array(
                'id' => 4,
                'serial_number' => 'DMAK02',
                'name' => 'RapidSense',
                'weight_no_payload' => 20,
                'cruise_speed' => 30,
                'climb_max_rate' => 12,
                'volume_payload_size' => '20x20x20',
                'wing_material' => 'Titanium Alloy',
                'fuselage_material' => 'Titanium Alloy',
                'filesave_system' => 'SSD',
                'control_system' => 'GPS + Inertial',
                'max_takeoff_weight' => 35,
                'max_flight_range' => 100,
                'max_speed' => 40,
                'max_cruise_height' => 3000,
                'operational_payload_weight' => 10,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Camera + Lidar',
                'operation_system' => 'Windows',
                'communication_system' => '5G + Satelite',
                'description' => 'High-capacity drone for intensive emission scanning',
            ),
            4 =>
            array(
                'id' => 5,
                'serial_number' => 'DSRG01',
                'name' => 'AeroTech',
                'weight_no_payload' => 12,
                'cruise_speed' => 22,
                'climb_max_rate' => 7,
                'volume_payload_size' => '30x30x20',
                'wing_material' => 'Carbon Fiber',
                'fuselage_material' => 'Carbon Fiber',
                'filesave_system' => 'SSD',
                'control_system' => 'GPS + Gyro',
                'max_takeoff_weight' => 22,
                'max_flight_range' => 45,
                'max_speed' => 28,
                'max_cruise_height' => 1900,
                'operational_payload_weight' => 4,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Laser + Camera',
                'operation_system' => 'Linux',
                'communication_system' => '4G + Satelite',
                'description' => 'Advanced drone for emissions research',
            ),
            5 =>
            array(
                'id' => 6,
                'serial_number' => 'DSRG02',
                'name' => 'HorizonScan',
                'weight_no_payload' => 18,
                'cruise_speed' => 28,
                'climb_max_rate' => 9,
                'volume_payload_size' => '25x25x25',
                'wing_material' => 'Aluminum Alloy',
                'fuselage_material' => 'Aluminum Alloy',
                'filesave_system' => 'HDD',
                'control_system' => 'GPS + Inertial',
                'max_takeoff_weight' => 28,
                'max_flight_range' => 60,
                'max_speed' => 32,
                'max_cruise_height' => 2200,
                'operational_payload_weight' => 6,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Camera + Ultrasonic',
                'operation_system' => 'Windows',
                'communication_system' => '4G + Satelite',
                'description' => 'Versatile drone for comprehensive scanning',
            ),
            6 =>
            array(
                'id' => 7,
                'serial_number' => 'DSUB01',
                'name' => 'EnviroScout',
                'weight_no_payload' => 9,
                'cruise_speed' => 20,
                'climb_max_rate' => 6,
                'volume_payload_size' => '25x25x20',
                'wing_material' => 'Composite',
                'fuselage_material' => 'Composite',
                'filesave_system' => 'SSD',
                'control_system' => 'GPS + Gyro',
                'max_takeoff_weight' => 19,
                'max_flight_range' => 42,
                'max_speed' => 26,
                'max_cruise_height' => 1700,
                'operational_payload_weight' => 3,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Laser + Camera',
                'operation_system' => 'Linux',
                'communication_system' => '4G + Wi-Fi',
                'description' => 'Eco-friendly drone with precision capabilities',
            ),
            7 =>
            array(
                'id' => 8,
                'serial_number' => 'DSUB02',
                'name' => 'TitanScan',
                'weight_no_payload' => 22,
                'cruise_speed' => 32,
                'climb_max_rate' => 14,
                'volume_payload_size' => '30x30x20',
                'wing_material' => 'Titanium Alloy',
                'fuselage_material' => 'Titanium Alloy',
                'filesave_system' => 'SSD',
                'control_system' => 'GPS + Inertial',
                'max_takeoff_weight' => 40,
                'max_flight_range' => 30,
                'max_speed' => 45,
                'max_cruise_height' => 3500,
                'operational_payload_weight' => 12,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Camera + Lidar',
                'operation_system' => 'Windows',
                'communication_system' => '5G + Satelite',
                'description' => 'Heavy-duty drone for large-scale emissions study',
            ),
            8 =>
            array(
                'id' => 9,
                'serial_number' => 'DTPR01',
                'name' => 'ProbeMaster',
                'weight_no_payload' => 6,
                'cruise_speed' => 16,
                'climb_max_rate' => 5,
                'volume_payload_size' => '20x20x20',
                'wing_material' => 'Carbon Fiber',
                'fuselage_material' => 'Carbon Fiber',
                'filesave_system' => 'SSD',
                'control_system' => 'GPS + Gyro',
                'max_takeoff_weight' => 18,
                'max_flight_range' => 35,
                'max_speed' => 22,
                'max_cruise_height' => 1500,
                'operational_payload_weight' => 2,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Laser + Camera',
                'operation_system' => 'Linux',
                'communication_system' => '4G + Satelite',
                'description' => 'Compact drone for precise emissions analysis',
            ),
            9 =>
            array(
                'id' => 10,
                'serial_number' => 'DTPR02',
                'name' => 'SwiftWing',
                'weight_no_payload' => 16,
                'cruise_speed' => 26,
                'climb_max_rate' => 8,
                'volume_payload_size' => '30x30x20',
                'wing_material' => 'Aluminum Alloy',
                'fuselage_material' => 'Aluminum Alloy',
                'filesave_system' => 'HDD',
                'control_system' => 'GPS + Inertial',
                'max_takeoff_weight' => 26,
                'max_flight_range' => 55,
                'max_speed' => 30,
                'max_cruise_height' => 2000,
                'operational_payload_weight' => 5,
                'proximity_sensor' => 'COx, NOx, SOx',
                'precision_landinig_mechanism' => 'Camera + Ultrasonic',
                'operation_system' => 'Windows',
                'communication_system' => '4G + Satelite',
                'description' => 'Agile drone for swift emissions monitoring',
            ),
        ));
    }
}
