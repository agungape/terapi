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
        Schema::table('terapis', function (Blueprint $table) {
            $table->string('jurusan')->nullable();
            $table->string('perguruan_tinggi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('terapis', function (Blueprint $table) {
            $table->dropColumn('jurusan');
            $table->dropColumn('perguruan_tinggi');
        });
    }
};
