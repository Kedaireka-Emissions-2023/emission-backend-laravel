<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drones', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->integer('weight_no_payload')->nullable();
            $table->decimal('cruise_speed', 10, 5)->nullable();
            $table->decimal('climb_max_rate', 10, 5)->nullable();
            $table->string('volume_payload_size')->nullable();
            $table->string('wing_material')->nullable();
            $table->string('fuselage_material')->nullable();
            $table->string('filesave_system')->nullable();
            $table->decimal('max_takeoff_weight', 10, 5)->nullable();
            $table->decimal('max_flight_range', 10, 5)->nullable();
            $table->decimal('max_speed', 10, 5)->nullable();
            $table->decimal('max_cruise_head', 10, 5)->nullable();
            $table->decimal('operational_payload_weight', 10, 5)->nullable();
            $table->string('proximity_sensor')->nullable();
            $table->string('precision_landinig_mechanism')->nullable();
            $table->string('operation_system')->nullable();
            $table->string('communication_system')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('drone_licences_id')->index('fk_drones_drone_licences1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drones');
    }
};
