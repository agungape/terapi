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
            $table->dropColumn('is_csr_antam');
            $table->foreignId('perusahaan_csr_id')->nullable()->after('kategori_id')->constrained('perusahaan_csrs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemasukkans', function (Blueprint $table) {
            $table->dropForeign(['perusahaan_csr_id']);
            $table->dropColumn('perusahaan_csr_id');
            $table->boolean('is_csr_antam')->default(false)->after('kategori_id');
        });
    }
};
