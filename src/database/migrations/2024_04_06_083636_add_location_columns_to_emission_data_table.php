<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emission_data', function (Blueprint $table) {
            $table->decimal('altitude', 10, 2)->after('time')->nullable();
            $table->decimal('latitude', 10, 6)->after('altitude')->nullable();
            $table->decimal('longitude', 10, 6)->after('latitude')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('emission_data', function (Blueprint $table) {
            $table->dropColumn(['altitude', 'latitude', 'longitude']);
        });
    }
};
