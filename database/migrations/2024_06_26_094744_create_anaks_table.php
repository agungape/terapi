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
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->string('diagnosa')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('telepon');
            $table->string('wali');
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
