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
        Schema::table('emissions', function (Blueprint $table) {
            $table->foreign(['vessel_id'], 'fk_drones_has_vessels_vessels1')->references(['id'])->on('vessels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['drone_id'], 'fk_drones_has_vessels_drones1')->references(['id'])->on('drones')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['port_id'], 'fk_drones_has_vessels_ports1')->references(['id'])->on('ports')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emissions', function (Blueprint $table) {
            $table->dropForeign('fk_drones_has_vessels_vessels1');
            $table->dropForeign('fk_drones_has_vessels_drones1');
            $table->dropForeign('fk_drones_has_vessels_ports1');
        });
    }
};
