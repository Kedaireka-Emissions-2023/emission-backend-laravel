<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('result_emissions', function (Blueprint $table) {
            $table->dropForeign('fk_result_emissions_emissions1');

            $table->foreign('emissions_id', 'fk_result_emissions_emissions1')
                ->references('id')->on('emissions')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::table('result_emissions', function (Blueprint $table) {
            $table->dropForeign('fk_result_emissions_emissions1');
        });
    }
};
