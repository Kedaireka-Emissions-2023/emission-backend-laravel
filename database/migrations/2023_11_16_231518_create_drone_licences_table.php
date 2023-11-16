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
        Schema::create('drone_licences', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('emergency_procedure')->nullable();
            $table->string('insurance_document')->nullable();
            $table->string('equipment_list')->nullable();
            $table->string('drone_photo')->nullable();
            $table->string('drone_certificate')->nullable();
            $table->date('expiration_date')->nullable();
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
        Schema::dropIfExists('drone_licences');
    }
};
