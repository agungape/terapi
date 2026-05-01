<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpsp_hasil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->foreignId('kpsp_kelompok_usia_id')->constrained('kpsp_kelompok_usias')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');
            $table->integer('total_ya')->default(0);
            $table->integer('total_tidak')->default(0);
            // S=Sesuai (9-10 ya), M=Meragukan (7-8 ya), P=Penyimpangan (<=6 ya)
            $table->enum('interpretasi', ['S', 'M', 'P'])->comment('S=Sesuai, M=Meragukan, P=Penyimpangan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpsp_hasil');
    }
};
