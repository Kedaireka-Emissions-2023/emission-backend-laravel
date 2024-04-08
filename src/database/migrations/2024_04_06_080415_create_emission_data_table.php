<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emission_data', function (Blueprint $table) {
            $table->id();
            $table->decimal('NO2', 8, 2);
            $table->decimal('NO', 8, 2);
            $table->decimal('SO2', 8, 2);
            $table->decimal('CO2', 8, 2);
            $table->decimal('CO', 8, 2);
            $table->decimal('PM2_5', 8, 2);
            $table->decimal('PM10', 8, 2);
            $table->dateTime('time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emission_data');
    }
};
