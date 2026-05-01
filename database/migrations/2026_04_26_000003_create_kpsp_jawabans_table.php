<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpsp_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->foreignId('kpsp_kelompok_usia_id')->constrained('kpsp_kelompok_usias')->onDelete('cascade');
            $table->foreignId('kpsp_pertanyaan_id')->constrained('kpsp_pertanyaans')->onDelete('cascade');
            $table->enum('jawaban', ['ya', 'tidak']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpsp_jawabans');
    }
};
