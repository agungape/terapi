<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tarifs', function (Blueprint $table) {
            // Jumlah pertemuan per paket (sesi), nullable agar data lama tetap valid
            $table->integer('jumlah_pertemuan')->nullable()->default(20)->after('tarif');
            // Jenis terapi yang dicakup paket ini
            $table->enum('jenis_terapi', ['terapi_perilaku', 'fisioterapi', 'semua'])->nullable()->after('jumlah_pertemuan');
            // Status aktif/tidak paket
            $table->boolean('is_active')->default(true)->after('jenis_terapi');
        });
    }

    public function down(): void
    {
        Schema::table('tarifs', function (Blueprint $table) {
            $table->dropColumn(['jumlah_pertemuan', 'jenis_terapi', 'is_active']);
        });
    }
};
