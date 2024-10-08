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
        Schema::create('terapis_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('terapis_id')->constrained()->onDelete('cascade');
            $table->foreignId('pelatihan_id')->constrained()->onDelete('cascade');
            $table->string('sertifikat')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terapis_pelatihan');
    }
};
