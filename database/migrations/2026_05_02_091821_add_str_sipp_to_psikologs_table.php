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
        Schema::table('psikologs', function (Blueprint $table) {
            $table->string('str')->nullable()->after('nama');
            $table->string('sipp')->nullable()->after('str');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('psikologs', function (Blueprint $table) {
            $table->dropColumn(['str', 'sipp']);
        });
    }
};
