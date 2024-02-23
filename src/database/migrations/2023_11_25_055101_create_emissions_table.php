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
        Schema::create('emissions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('drone_id')->index('fk_drones_has_vessels_drones1_idx');
            $table->integer('vessel_id')->index('fk_drones_has_vessels_vessels1_idx');
            $table->string('name')->nullable();
            $table->schemalessAttributes('pilot')->nullable();
            $table->schemalessAttributes('preparation')->nullable();
            $table->date('date')->nullable();
            $table->decimal('levels', 10, 5)->nullable()->comment('Emission percentage (%)');
            $table->decimal('lkh_th', 10, 5)->nullable()->comment('LKH Threshold');
            $table->decimal('osha_th', 10, 5)->nullable();
            $table->decimal('who_th', 10, 5)->nullable();
            $table->enum('result', ['Success', 'Failed'])->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emissions');
    }
};
