<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anthropometris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->date('tanggal_pengukuran');
            $table->decimal('berat_badan', 5, 2)->nullable()->comment('Dalam kg');
            $table->decimal('tinggi_badan', 5, 2)->nullable()->comment('Dalam cm');
            $table->decimal('lingkar_kepala', 5, 2)->nullable()->comment('Dalam cm');
            $table->decimal('lingkar_lengan_atas', 5, 2)->nullable()->comment('Dalam cm');
            $table->integer('usia_bulan')->nullable()->comment('Usia anak saat diukur dalam bulan');
            // Interpretasi masing-masing indikator (mengacu kurva WHO)
            $table->string('status_bb_u')->nullable()->comment('BB/U: Gizi Buruk/Kurang/Normal/Lebih');
            $table->string('status_tb_u')->nullable()->comment('TB/U: Sangat Pendek/Pendek/Normal/Tinggi');
            $table->string('status_bb_tb')->nullable()->comment('BB/TB: Kurus/Normal/Gemuk');
            $table->string('status_lk_u')->nullable()->comment('LK/U: Mikrosefali/Normal/Makrosefali');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anthropometris');
    }
};
