<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpsp_kelompok_usias', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // e.g. "3bln", "6bln"
            $table->string('nama'); // e.g. "3 Bulan"
            $table->integer('usia_bulan'); // 3, 6, 9, ...72
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpsp_kelompok_usias');
    }
};
