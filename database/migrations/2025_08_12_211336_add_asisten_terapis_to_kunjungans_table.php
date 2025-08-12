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
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->foreignId('terapis_id_pendamping')
                ->nullable()
                ->constrained('terapis')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['terapis_id_pendamping']);
            // Hapus kolom
            $table->dropColumn('terapis_id_pendamping');
        });
    }
};
