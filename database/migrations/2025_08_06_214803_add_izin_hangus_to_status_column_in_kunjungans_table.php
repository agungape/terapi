<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Untuk MySQL
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->enum('status_temp', ['hadir', 'izin', 'sakit', 'izin_hangus'])
                ->nullable()
                ->after('status');
        });

        // Copy data dari kolom lama ke temporary
        \DB::table('kunjungans')->update([
            'status_temp' => \DB::raw('status')
        ]);

        // Hapus kolom lama
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Buat kolom baru dengan nama yang sama
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->enum('status', ['hadir', 'izin', 'sakit', 'izin_hangus'])
                ->after('catatan');
        });

        // Copy data kembali
        \DB::table('kunjungans')->update([
            'status' => \DB::raw('status_temp')
        ]);

        // Hapus kolom temporary
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn('status_temp');
        });
    }

    public function down()
    {
        // Proses sebaliknya untuk rollback
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->enum('status_temp', ['hadir', 'izin', 'sakit'])
                ->nullable()
                ->after('status');
        });

        \DB::table('kunjungans')->update([
            'status_temp' => \DB::raw('status')
        ]);

        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('kunjungans', function (Blueprint $table) {
            $table->enum('status', ['hadir', 'izin', 'sakit'])
                ->after('catatan');
        });

        \DB::table('kunjungans')->update([
            'status' => \DB::raw('status_temp')
        ]);

        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn('status_temp');
        });
    }
};
