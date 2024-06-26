<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            $table->integer('duration_apx')->nullable()->after('time');
        });
    }

    public function down(): void
    {
        Schema::table('emissions', function (Blueprint $table) {
            $table->dropColumn('duration_apx');
        });
    }
};
