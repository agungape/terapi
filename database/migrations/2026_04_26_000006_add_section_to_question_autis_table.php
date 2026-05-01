<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom 'section' ke question_autis untuk membedakan CHAT Section A dan B.
     * Section A = pertanyaan ke orang tua (9 item)
     * Section B = observasi langsung terapis (5 item)
     */
    public function up(): void
    {
        Schema::table('question_autis', function (Blueprint $table) {
            $table->enum('section', ['A', 'B'])->default('A')->after('no_urut')
                ->comment('A=Pertanyaan ke Orang Tua, B=Observasi Langsung Terapis');
        });
    }

    public function down(): void
    {
        Schema::table('question_autis', function (Blueprint $table) {
            $table->dropColumn('section');
        });
    }
};
