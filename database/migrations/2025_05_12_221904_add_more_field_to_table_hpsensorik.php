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
        Schema::table('hp_sensoriks', function (Blueprint $table) {
            $table->foreignId('anak_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hp_sensoriks', function (Blueprint $table) {
            Schema::dropIfExists('hp_sensoriks');
        });
    }
};
