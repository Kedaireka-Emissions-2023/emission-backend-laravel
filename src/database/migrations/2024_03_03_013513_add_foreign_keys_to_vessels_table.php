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
        Schema::table('vessels', function (Blueprint $table) {
            $table->foreign(['port_id'], 'fk_vessels_port')->references(['id'])->on('ports')->onDelete('SET NULL');
            $table->foreign(['port_id'], 'fk_vessels_ports')->references(['id'])->on('ports')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->dropForeign('fk_vessels_port');
            $table->dropForeign('fk_vessels_ports');
        });
    }
};
