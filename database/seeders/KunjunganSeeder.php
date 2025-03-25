<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kunjungan;
use App\Models\Anak;
use App\Models\Terapis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KunjunganSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Nonaktifkan foreign key constraint
        Kunjungan::query()->delete(); // Hapus semua data tanpa truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Aktifkan kembali foreign key constraint

        $anak = Anak::where('nama', 'Bajragin Kuswandari')->first(); // Ambil anak dengan nama tertentu
        $terapis = Terapis::inRandomOrder()->first(); // Ambil satu terapis secara acak

        if ($anak) {
            $createdAt = now()->subDays(40); // Set tanggal awal agar data yang dibuat lebih dulu punya timestamp lebih lama

            for ($sesi = 1; $sesi <= 2; $sesi++) {
                for ($pertemuan = 1; $pertemuan <= 20; $pertemuan++) {
                    Kunjungan::create([
                        'anak_id' => $anak->id,
                        'terapis_id' => $terapis->id,
                        'pertemuan' => $pertemuan,
                        'catatan' => 'Catatan untuk pertemuan ke-' . $pertemuan,
                        'status' => 'hadir', // Semua pertemuan statusnya hadir
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]);

                    $createdAt = $createdAt->addDay(); // Tambahkan 1 hari untuk setiap pertemuan agar timestamp lebih duluan untuk data yang dibuat lebih awal
                }
            }
        } else {
            $this->command->error('Anak dengan nama "Bajragin Kuswandari" tidak ditemukan. Pastikan data anak sudah ada di database.');
        }
    }
}
