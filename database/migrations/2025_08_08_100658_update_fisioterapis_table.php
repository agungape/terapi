<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('fisioterapis', function (Blueprint $table) {
            // Hapus kolom yang tidak diperlukan
            $table->dropColumn(['respons_anak', 'kemajuan', 'kendala']);

            // Tambah kolom baru (jika belum ada)
            if (!Schema::hasColumn('fisioterapis', 'evaluasi')) {
                $table->text('evaluasi')->nullable();
            }

            // Jika kolom catatan_khusus sudah ada, tidak perlu dilakukan apa-apa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('fisioterapis', function (Blueprint $table) {
            // Kembalikan kolom yang dihapus
            $table->text('respons_anak')->nullable();
            $table->text('kemajuan')->nullable();
            $table->text('kendala')->nullable();

            // Hapus kolom yang ditambahkan
            $table->dropColumn('evaluasi');
        });
    }
};
