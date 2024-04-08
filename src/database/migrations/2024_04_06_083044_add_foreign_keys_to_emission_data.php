<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emission_data', function (Blueprint $table) {
            $table->integer('emission_id')->after('id')->nullable();

            $table->foreign('emission_id', 'emission_data_emission_fk')
                ->references('id')->on('emissions')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('emission_data', function (Blueprint $table) {
            $table->dropForeign('emission_data_emission_fk');
            $table->dropColumn('emission_id');
        });
    }
};
