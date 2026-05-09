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
        Schema::table('fisioterapis', function (Blueprint $table) {
            $table->text('pilihan_respons')->nullable()->after('catatan_khusus');
            $table->string('hasil_kegiatan')->nullable()->after('pilihan_respons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fisioterapis', function (Blueprint $table) {
            $table->dropColumn(['pilihan_respons', 'hasil_kegiatan']);
        });
    }
};
