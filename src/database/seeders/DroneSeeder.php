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
                'name' => 'Drone 1',
                'serial_number' => 123456789,
                'weight_no_payload' => 1,
                'cruise_speed' => 1,
                'climb_max_rate' => 1,
                'volume_payload_size' => '1',
                'wing_material' => '1',
                'fuselage_material' => '1',
                'filesave_system' => '1',
                'control_system' => '1',
                'max_takeoff_weight' => 1,
                'max_flight_range' => 1,
                'max_speed' => 1,
                'max_cruise_height' => 1,
                'operational_payload_weight' => 1,
                'proximity_sensor' => '1',
                'precision_landinig_mechanism' => '1',
                'operation_system' => '1',
                'communication_system' => '1',
                'description' => '1',
                'cert_emergency_procedure' => '1',
                'cert_insurance_doc' => '1',
                'cert_equipment_list' => '1',
                'cert_drone_photo' => '1',
                'cert_drone_certificate' => '1',
                'expiration_date' => '2021-01-01',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Drone 2',
                'serial_number' => 123456789,
                'weight_no_payload' => 1,
                'cruise_speed' => 1,
                'climb_max_rate' => 1,
                'volume_payload_size' => '1',
                'wing_material' => '1',
                'fuselage_material' => '1',
                'filesave_system' => '1',
                'control_system' => '1',
                'max_takeoff_weight' => 1,
                'max_flight_range' => 1,
                'max_speed' => 1,
                'max_cruise_height' => 1,
                'operational_payload_weight' => 1,
                'proximity_sensor' => '1',
                'precision_landinig_mechanism' => '1',
                'operation_system' => '1',
                'communication_system' => '1',
                'description' => '1',
                'cert_emergency_procedure' => '1',
                'cert_insurance_doc' => '1',
                'cert_equipment_list' => '1',
                'cert_drone_photo' => '1',
                'cert_drone_certificate' => '1',
                'expiration_date' => '2021-01-01',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Drone 3',
                'serial_number' => 123456789,
                'weight_no_payload' => 1,
                'cruise_speed' => 1,
                'climb_max_rate' => 1,
                'volume_payload_size' => '1',
                'wing_material' => '1',
                'fuselage_material' => '1',
                'filesave_system' => '1',
                'control_system' => '1',
                'max_takeoff_weight' => 1,
                'max_flight_range' => 1,
                'max_speed' => 1,
                'max_cruise_height' => 1,
                'operational_payload_weight' => 1,
                'proximity_sensor' => '1',
                'precision_landinig_mechanism' => '1',
                'operation_system' => '1',
                'communication_system' => '1',
                'description' => '1',
                'cert_emergency_procedure' => '1',
                'cert_insurance_doc' => '1',
                'cert_equipment_list' => '1',
                'cert_drone_photo' => '1',
                'cert_drone_certificate' => '1',
                'expiration_date' => '2021-01-01',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
        ));
    }
}
