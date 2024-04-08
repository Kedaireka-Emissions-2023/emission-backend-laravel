<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emission_data', function (Blueprint $table) {
            $table->decimal('NO2', 8, 2)->nullable()->change();
            $table->decimal('NO', 8, 2)->nullable()->change();
            $table->decimal('SO2', 8, 2)->nullable()->change();
            $table->decimal('CO2', 8, 2)->nullable()->change();
            $table->decimal('CO', 8, 2)->nullable()->change();
            $table->decimal('PM2_5', 8, 2)->nullable()->change();
            $table->decimal('PM10', 8, 2)->nullable()->change();
            $table->decimal('altitude', 8, 2)->nullable()->change();
            $table->decimal('latitude', 8, 2)->nullable()->change();
            $table->decimal('longitude', 8, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('emission_data', function (Blueprint $table) {
            $table->decimal('NO2', 8, 2)->nullable(false)->change();
            $table->decimal('NO', 8, 2)->nullable(false)->change();
            $table->decimal('SO2', 8, 2)->nullable(false)->change();
            $table->decimal('CO2', 8, 2)->nullable(false)->change();
            $table->decimal('CO', 8, 2)->nullable(false)->change();
            $table->decimal('PM2_5', 8, 2)->nullable(false)->change();
            $table->decimal('PM10', 8, 2)->nullable(false)->change();
            $table->decimal('altitude', 8, 2)->nullable(false)->change();
            $table->decimal('latitude', 8, 2)->nullable(false)->change();
            $table->decimal('longitude', 8, 2)->nullable(false)->change();
        });
    }
};
