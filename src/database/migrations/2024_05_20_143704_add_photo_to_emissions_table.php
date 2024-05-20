<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('emissions', function (Blueprint $table) {
            $table->json('photo')->nullable();
        });
    }

    public function down()
    {
        Schema::table('emissions', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
};
