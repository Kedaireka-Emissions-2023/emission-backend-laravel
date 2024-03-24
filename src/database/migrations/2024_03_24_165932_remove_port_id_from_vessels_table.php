<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->dropForeign('fk_vessels_port');
            $table->dropForeign('fk_vessels_ports');
        });

        Schema::table('vessels', function (Blueprint $table) {
            $table->dropColumn('port_id');
        });
    }

    public function down(): void
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->unsignedBigInteger('port_id')->nullable();
            $table->foreign('port_id')->references('id')->on('ports')->onDelete('cascade');
        });
    }
};
