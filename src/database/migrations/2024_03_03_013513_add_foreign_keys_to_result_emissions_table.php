<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('result_emissions', function (Blueprint $table) {
            $table->foreign(['emissions_id'], 'fk_result_emissions_emissions1')->references(['id'])->on('emissions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('result_emissions', function (Blueprint $table) {
            $table->dropForeign('fk_result_emissions_emissions1');
        });
    }
};
