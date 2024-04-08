<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emission_data', function (Blueprint $table) {
            Schema::table('emission_data', function (Blueprint $table) {
                $table->date('date')->after('time')->nullable();
                $table->time('time_only')->after('date')->nullable();
            });

            DB::statement("UPDATE emission_data SET date = DATE(time), time_only = TIME(time)");

            Schema::table('emission_data', function (Blueprint $table) {
                $table->dropColumn('time');
                $table->renameColumn('time_only', 'time');
            });
        });
    }

    public function down(): void
    {
        Schema::table('emission_data', function (Blueprint $table) {
            $table->datetime('time')->after('time_only');
            DB::statement("UPDATE emission_data SET time = CONCAT(date, ' ', time)");

            $table->dropColumn(['date', 'time_only']);
        });
    }
};
