<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->string('main_eng')->nullable()->after('main_eng_total');
            $table->string('aux_eng')->nullable()->after('aux_eng_total');
        });
    }

    public function down(): void
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->dropColumn(['main_eng', 'aux_eng']);
        });
    }
};
