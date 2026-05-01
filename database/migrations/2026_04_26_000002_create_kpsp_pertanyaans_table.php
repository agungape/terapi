<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpsp_pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpsp_kelompok_usia_id')->constrained('kpsp_kelompok_usias')->onDelete('cascade');
            $table->integer('no_urut')->default(1);
            $table->text('pertanyaan');
            $table->enum('bidang', ['PS', 'MH', 'B', 'MK'])->comment('PS=Personal-Sosial, MH=Motorik Halus, B=Bahasa, MK=Motorik Kasar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpsp_pertanyaans');
    }
};
