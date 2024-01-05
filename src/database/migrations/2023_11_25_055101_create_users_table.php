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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('email_recovery')->nullable();
            $table->string('password');
            $table->enum('role', ['PILOT', 'BKI', 'PORT']);
            $table->string('company_name')->nullable();
            $table->string('phone_number')->nullable()->comment('
');
            $table->string('company_address')->nullable();
            $table->string('nik')->nullable();
            $table->enum('status', ['VALID', 'EXPIRED'])->nullable()->default('EXPIRED');

            $table->string('ktp')->nullable();
            $table->string('certificate')->nullable();
            $table->dateTime('exp_certificate')->nullable();

            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
