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
        Schema::create('vessels', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('imo_number')->nullable();
            $table->string('name');
            $table->string('type')->nullable();
            $table->enum('status', ['ACTIVE', 'ON-HOLD', 'UNACTIVE'])->nullable();
            $table->integer('dwt')->nullable();
            $table->integer('gt')->nullable();
            $table->string('voyage_route_from')->nullable();
            $table->string('voyage_route_to')->nullable();
            $table->integer('vessel_speed')->nullable()->comment('vessel_speed (knot)');
            $table->integer('berth')->nullable()->comment('unload_duration');
            $table->integer('draft')->nullable()->comment('Draft (T)');
            $table->integer('length')->nullable()->comment('length(lpp)');
            $table->integer('width')->nullable()->comment('Width (B)');
            $table->integer('main_eng')->nullable();
            $table->integer('main_eng_power')->nullable()->comment('Main Engine Power (HP)');
            $table->integer('aux_eng')->nullable()->comment('Number of Auxiliary Engines');
            $table->integer('aux_power')->nullable()->comment('Auxiliary Power (Kw)');
            $table->string('main_eng_fuel')->nullable();
            $table->string('aux_eng_fuel')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('ports_id')->index('fk_vessels_ports_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessels');
    }
};
