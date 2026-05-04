<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tambah kolom pertemuan per-jenis (untuk paket gabungan)
     * dan perluas enum jenis_terapi dengan: gabungan, assessment, observasi
     * 
     * Data lama (terapi_perilaku, fisioterapi) tidak terpengaruh.
     * Nilai 'semua' tidak ada di DB production (dikonfirmasi via tinker).
     */
    public function up(): void
    {
        // Step 1: Tambah kolom pertemuan per-jenis
        Schema::table('tarifs', function (Blueprint $table) {
            $table->integer('pertemuan_perilaku')
                  ->nullable()
                  ->after('jumlah_pertemuan')
                  ->comment('Jumlah sesi terapi perilaku (hanya untuk paket gabungan)');

            $table->integer('pertemuan_fisioterapi')
                  ->nullable()
                  ->after('pertemuan_perilaku')
                  ->comment('Jumlah sesi fisioterapi (hanya untuk paket gabungan)');
        });

        // Step 2: Perluas enum jenis_terapi
        // MySQL memerlukan MODIFY COLUMN untuk mengubah enum
        DB::statement("
            ALTER TABLE tarifs 
            MODIFY COLUMN jenis_terapi 
            ENUM('terapi_perilaku','fisioterapi','gabungan','assessment','observasi') 
            NULL
        ");
    }

    public function down(): void
    {
        // Kembalikan enum ke nilai lama (tanpa gabungan/assessment/observasi)
        DB::statement("
            ALTER TABLE tarifs 
            MODIFY COLUMN jenis_terapi 
            ENUM('terapi_perilaku','fisioterapi','semua') 
            NULL
        ");

        Schema::table('tarifs', function (Blueprint $table) {
            $table->dropColumn(['pertemuan_perilaku', 'pertemuan_fisioterapi']);
        });
    }
};
