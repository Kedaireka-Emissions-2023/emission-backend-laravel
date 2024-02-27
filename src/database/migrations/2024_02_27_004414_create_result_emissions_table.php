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
        Schema::create('result_emissions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('emissions_id')->index('fk_result_emissions_emissions1_idx');
            $table->enum('result', ['Success', 'Failed'])->nullable();
            $table->enum('failure_mode', ['L', 'M'])->nullable();
            $table->text('effect')->nullable();
            $table->text('cause')->nullable();
            $table->text('possible_action')->nullable();
            $table->text('ref_protocol')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_emissions');
    }
};
