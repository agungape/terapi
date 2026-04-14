<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_alat_ukurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->foreignId('alat_ukur_id')->constrained()->onDelete('cascade');
            // Skor mentah (raw score) yang diinput psikolog
            $table->integer('skor_raw')->nullable();
            // Skor standar (scaled/standard score) — dihitung otomatis atau diinput manual
            $table->integer('skor_standar')->nullable();
            // Persentil hasil tes
            $table->integer('persentil')->nullable();
            // Klasifikasi otomatis berdasarkan norma alat ukur (mis: "Di Bawah Rata-rata")
            $table->string('klasifikasi')->nullable();
            // Catatan khusus untuk alat ukur ini
            $table->text('catatan')->nullable();
            // Flag apakah skor ini diinput manual (bukan auto-calculated)
            $table->boolean('is_manual')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_alat_ukurs');
    }
};
