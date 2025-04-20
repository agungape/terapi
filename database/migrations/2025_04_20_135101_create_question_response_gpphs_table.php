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
        Schema::create('question_response_gpphs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_gpph_id')->constrained('question_gpphs')->onDelete('cascade');
            $table->tinyInteger('answer')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_response_gpphs');
    }
};
