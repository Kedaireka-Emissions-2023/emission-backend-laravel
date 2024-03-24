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
        });
    }

    public function down(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            $table->foreign('drone_id', 'fk_drones_has_vessels_ports1')
                ->references('id')->on('ports')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }
};
