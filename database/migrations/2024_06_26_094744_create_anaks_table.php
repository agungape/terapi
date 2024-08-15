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
        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->char('nib', 6)->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pendidikan')->nullable();
            $table->string('alamat');
            $table->integer('anak_ke')->nullable();
            $table->integer('total_saudara')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('telepon_ayah')->nullable();
            $table->string('telepon_ibu')->nullable();
            $table->string('umur_ayah')->nullable();
            $table->string('umur_ibu')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('agama_ayah')->nullable();
            $table->string('agama_ibu')->nullable();
            $table->string('alamat_ayah')->nullable();
            $table->string('alamat_ibu')->nullable();
            $table->string('suku_ayah')->nullable();
            $table->string('suku_ibu')->nullable();
            $table->string('pernikahan_ayah')->nullable();
            $table->string('pernikahan_ibu')->nullable();
            $table->string('usia_saat_hamil_ayah')->nullable();
            $table->string('usia_saat_hamil_ibu')->nullable();
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anaks');
    }
};
