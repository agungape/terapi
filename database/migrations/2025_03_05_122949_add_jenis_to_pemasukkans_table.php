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
        Schema::table('pemasukkans', function (Blueprint $table) {
            $table->foreignId('tarif_id')->nullable()->constrained('tarifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemasukkans', function (Blueprint $table) {
            $table->dropForeign(['tarif_id']);
            $table->dropColumn('tarif_id');
        });
    }
};
