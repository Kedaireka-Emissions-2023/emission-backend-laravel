<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('port_id')->nullable()->after('status');
                $table->foreign('port_id')->references('id')->on('ports')->onDelete('cascade')->onUpdate('cascade');
            });
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['port_id']);
            $table->dropColumn('port_id');
        });
    }
};
