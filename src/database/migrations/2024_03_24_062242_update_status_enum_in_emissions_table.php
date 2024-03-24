<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            DB::statement("ALTER TABLE emissions MODIFY COLUMN status ENUM('LOW', 'MEDIUM', 'HIGH', 'PROCESS') NOT NULL");
        });
    }

    public function down(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            DB::statement("ALTER TABLE emissions MODIFY COLUMN status ENUM('process', 'low', 'medium', 'high') NOT NULL");
        });
    }
};
