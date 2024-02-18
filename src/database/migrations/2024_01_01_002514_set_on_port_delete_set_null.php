<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->integer('port_id')->nullable()->change();
            $table->foreign('port_id', 'fk_vessels_port')
                ->references('id')->on('ports')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->dropForeign('fk_vessels_port');
            $table->integer('port_id')->nullable(false)->change();
        });
    }
};
