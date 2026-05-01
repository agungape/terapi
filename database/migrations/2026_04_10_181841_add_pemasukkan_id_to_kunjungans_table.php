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
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->unsignedBigInteger('pemasukkan_id')->nullable()->after('terapis_id');
            
            // Opsional: Jika ingin foreign key constraint
            // $table->foreign('pemasukkan_id')->references('id')->on('pemasukkans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn('pemasukkan_id');
        });
    }
};
