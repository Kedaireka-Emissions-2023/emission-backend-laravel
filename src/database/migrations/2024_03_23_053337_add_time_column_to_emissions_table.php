<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            $table->time('time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            Schema::table('emissions', function (Blueprint $table) {
                $table->dropColumn('time');
            });
        });
    }
};
