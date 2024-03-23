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
            $table->renameColumn('main_eng', 'main_eng_total');
            $table->renameColumn('aux_eng', 'aux_eng_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->renameColumn('main_eng_total', 'main_eng');
            $table->renameColumn('aux_eng_total', 'aux_eng');
        });
    }
};
