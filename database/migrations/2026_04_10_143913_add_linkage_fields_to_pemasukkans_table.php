<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemasukkans', function (Blueprint $table) {
            // Link langsung ke anak yang membayar (tidak lagi hanya via teks deskripsi)
            $table->unsignedBigInteger('anak_id')->nullable()->after('kategori_id');
            $table->foreign('anak_id')->references('id')->on('anaks')->onDelete('set null');

            // Link ke assessment yang dibayar (jika pembayaran untuk assessment)
            $table->unsignedBigInteger('assessment_id')->nullable()->after('anak_id');
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('set null');

            // Link ke paket terapi (tarif) yang dibayar - tarif_id sudah ada dari migration lama
            // Pastikan kolom tarif_id ada foreign key jika belum
            // (sudah ada di migration 2025_03_05_122949)

            // Klasifikasi jenis layanan yang dibayar
            $table->enum('jenis_layanan', ['assessment', 'paket_terapi', 'lainnya'])->nullable()->after('assessment_id');

            // Metode pembayaran — sebelumnya hanya ada di UI tapi tidak disimpan ke DB!
            $table->enum('metode_bayar', ['tunai', 'transfer'])->nullable()->after('jenis_layanan');

            // Nomor sesi yang dibayar dalam paket (jika relevan)
            $table->integer('sesi_dibayar')->nullable()->after('metode_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('pemasukkans', function (Blueprint $table) {
            $table->dropForeign(['anak_id']);
            $table->dropForeign(['assessment_id']);
            $table->dropColumn(['anak_id', 'assessment_id', 'jenis_layanan', 'metode_bayar', 'sesi_dibayar']);
        });
    }
};
