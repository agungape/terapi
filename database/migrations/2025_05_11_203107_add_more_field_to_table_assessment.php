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
            $table->text('assessment_awal')->nullable();
            $table->text('diagnosa')->nullable();
            $table->date('tanggal_assessment')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->text('catatan_tambahan')->nullable();
            $table->text('tindak_lanjut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            //
        });
    }
};
