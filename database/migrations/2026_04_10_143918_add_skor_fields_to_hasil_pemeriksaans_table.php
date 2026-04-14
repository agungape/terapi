<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {
            // Total skor observasi numerik (untuk GPPH, Autisme, Perilaku, dll)
            $table->integer('total_skor')->nullable()->after('hasil');
            // Teks interpretasi berdasarkan skor
            $table->string('interpretasi')->nullable()->after('total_skor');
            // Catatan klinis tambahan dari terapis/dokter
            $table->text('catatan_klinis')->nullable()->after('interpretasi');
            // Tanggal pemeriksaan eksplisit (alternatif dari created_at)
            $table->date('tanggal_pemeriksaan')->nullable()->after('catatan_klinis');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {
            $table->dropColumn(['total_skor', 'interpretasi', 'catatan_klinis', 'tanggal_pemeriksaan']);
        });
    }
};
