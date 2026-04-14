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
        Schema::table('assessments', function (Blueprint $table) {
            // Tab Data Umum
            $table->text('keluhan_utama')->nullable()->after('tujuan_pemeriksaan');
            
            // Tab Kondisi/Observasi
            $table->string('mood_anak')->nullable()->after('kesimpulan_observasi');
            $table->string('validitas_hasil')->nullable()->after('mood_anak');
            $table->text('catatan_rapport')->nullable()->after('validitas_hasil');
            
            // Red Flags / Spesifik ABK
            $table->string('kontak_mata')->nullable()->after('catatan_rapport');
            $table->string('komunikasi')->nullable()->after('kontak_mata');
            $table->string('interaksi_sosial')->nullable()->after('komunikasi');
            
            // Tab Hasil
            $table->text('diagnosa_banding')->nullable()->after('diagnosa');
            
            // Tab Rekomendasi
            $table->text('saran_rujukan')->nullable()->after('rekomendasi_terapi');
            $table->text('prioritas_terapi')->nullable()->after('saran_rujukan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn([
                'keluhan_utama', 'mood_anak', 'validitas_hasil', 'catatan_rapport',
                'kontak_mata', 'komunikasi', 'interaksi_sosial',
                'diagnosa_banding', 'saran_rujukan', 'prioritas_terapi'
            ]);
        });
    }
};
