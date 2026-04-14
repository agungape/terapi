<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alat_ukurs', function (Blueprint $table) {
            $table->id();
            // Nama lengkap alat tes, contoh: "Wechsler Preschool and Primary Scale of Intelligence"
            $table->string('nama');
            // Singkatan/kode, contoh: "WPPSI-IV"
            $table->string('singkatan')->nullable();
            // Domain yang diukur: kognitif, bahasa, motorik, sosial, perilaku_adaptif, komprehensif
            $table->enum('domain', ['kognitif', 'bahasa', 'motorik', 'sosial_emosional', 'perilaku_adaptif', 'komprehensif', 'lainnya'])->default('komprehensif');
            // Rentang usia yang bisa dites (dalam bulan)
            $table->integer('min_usia_bulan')->nullable();
            $table->integer('max_usia_bulan')->nullable();
            // Rentang skor valid untuk alat ini
            $table->integer('min_skor')->nullable();
            $table->integer('max_skor')->nullable();
            // Deskripsi alat ukur
            $table->text('deskripsi')->nullable();
            // Referensi norma interpretasi (JSON: [{min:x, max:y, label:"Rata-rata"}, ...])
            $table->json('norma_interpretasi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alat_ukurs');
    }
};
