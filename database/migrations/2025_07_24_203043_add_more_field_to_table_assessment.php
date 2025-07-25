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
            $table->text('tujuan_pemeriksaan');
            $table->json('sumber_asesmen');
            $table->json('observasi_awal');
            $table->json('hasil_pemeriksaan');
            $table->json('rekomendasi_orangtua');
            $table->json('rekomendasi_terapi');
            $table->boolean('persetujuan_psikolog')->default(false);
            $table->text('alasan_tidak_setuju')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn('tujuan_pemeriksaan');
            $table->dropColumn('sumber_asesmen');
            $table->dropColumn('observasi_awal');
            $table->dropColumn('hasil_pemeriksaan');
            $table->dropColumn('rekomendasi_orangtua');
            $table->dropColumn('rekomendasi_terapi');
            $table->dropColumn('persetujuan_psikolog');
            $table->dropColumn('alasan_tidak_setuju');
        });
    }
};
