<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            $table->dropForeign('fk_drones_has_vessels_ports1');
            $table->dropForeign('fk_drones_has_vessels_vessels1');
            $table->dropForeign('fk_drones_has_vessels_drones1');

            $table->foreign('drone_id', 'fk_drones_has_vessels_ports1')
                ->references('id')->on('ports')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('vessel_id', 'fk_drones_has_vessels_vessels1')
                ->references('id')->on('vessels')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('port_id', 'fk_drones_has_vessels_drones1')
                ->references('id')->on('drones')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            if (Schema::hasTable('emissions') && Schema::hasForeignKey('emissions', 'fk_drones_has_vessels_drones1')) {
                $table->dropForeign('fk_drones_has_vessels_drones1');
            }

            if (Schema::hasTable('emissions') && Schema::hasForeignKey('emissions', 'fk_drones_has_vessels_vessels1')) {
                $table->dropForeign('fk_drones_has_vessels_vessels1');
            }

            if (Schema::hasTable('emissions') && Schema::hasForeignKey('emissions', 'fk_drones_has_vessels_ports1')) {
                $table->dropForeign('fk_drones_has_vessels_ports1');
            }
        });
    }
};
