<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            // Skor per domain psikologi — semua nullable agar data lama tidak error
            $table->integer('skor_kognitif')->nullable()->after('catatan_tambahan');
            $table->integer('skor_bahasa')->nullable()->after('skor_kognitif');
            $table->integer('skor_motorik')->nullable()->after('skor_bahasa');
            $table->integer('skor_sosial_emosional')->nullable()->after('skor_motorik');
            $table->integer('skor_perilaku_adaptif')->nullable()->after('skor_sosial_emosional');
            // Skor IQ keseluruhan (jika ada)
            $table->integer('skor_iq_total')->nullable()->after('skor_perilaku_adaptif');
            // Klasifikasi kemampuan berdasarkan skor IQ/skor total
            $table->string('klasifikasi')->nullable()->after('skor_iq_total');
            // Catatan interpretasi skor keseluruhan
            $table->text('interpretasi_skor')->nullable()->after('klasifikasi');
            // Status pembayaran assessment ini (lunas/belum)
            $table->enum('status_bayar', ['belum_bayar', 'lunas'])->default('belum_bayar')->after('interpretasi_skor');
        });
    }

    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn([
                'skor_kognitif', 'skor_bahasa', 'skor_motorik',
                'skor_sosial_emosional', 'skor_perilaku_adaptif',
                'skor_iq_total', 'klasifikasi', 'interpretasi_skor', 'status_bayar'
            ]);
        });
    }
};
