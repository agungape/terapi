<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Terapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalisiskinerjaController extends Controller
{
    public function analisis_kinerja(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai'
        ]);

        // Set default tanggal jika tidak ada input
        $tanggalMulai = $request->tanggal_mulai ?? now()->startOfMonth()->format('Y-m-d');
        $tanggalSelesai = $request->tanggal_selesai ?? now()->endOfMonth()->format('Y-m-d');

        // Query untuk mendapatkan jumlah anak unik per terapis dalam rentang tanggal dengan status hadir
        $daftarTerapis = Terapis::select([
            'terapis.id',
            'terapis.nama',
            'terapis.role',
            DB::raw('COUNT(DISTINCT kunjungans.anak_id) as jumlah_anak')
        ])
            ->leftJoin('kunjungans', function ($join) use ($tanggalMulai, $tanggalSelesai) {
                $join->on('terapis.id', '=', 'kunjungans.terapis_id')
                    ->whereBetween('kunjungans.created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
                    ->where('kunjungans.status', 'hadir');
            })
            ->groupBy('terapis.id', 'terapis.nama', 'terapis.role')
            ->orderBy('jumlah_anak', 'desc')
            ->paginate(10);

        // Total terapis
        $totalTerapis = Terapis::count();

        // Total anak unik dalam periode dengan status hadir
        $totalAnak = Kunjungan::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
            ->where('status', 'hadir')
            ->distinct('anak_id')
            ->count('anak_id');

        // Total sesi dalam periode dengan status hadir
        $totalSesi = Kunjungan::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
            ->where('status', 'hadir')
            ->count();

        // Terapis dengan jumlah anak terbanyak (hitung hanya yang hadir)
        $terapisTerbaik = Terapis::select([
            'terapis.id',
            'terapis.nama',
            DB::raw('COUNT(DISTINCT kunjungans.anak_id) as jumlah_anak')
        ])
            ->leftJoin('kunjungans', function ($join) use ($tanggalMulai, $tanggalSelesai) {
                $join->on('terapis.id', '=', 'kunjungans.terapis_id')
                    ->whereBetween('kunjungans.created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
                    ->where('kunjungans.status', 'hadir');
            })
            ->groupBy('terapis.id', 'terapis.nama')
            ->orderBy('jumlah_anak', 'desc')
            ->first();

        // Data untuk chart (hanya yang hadir)
        $namaTerapis = $daftarTerapis->pluck('nama');
        $jumlahAnak = $daftarTerapis->pluck('jumlah_anak');

        $maxAnak = $jumlahAnak->max() ?: 1;

        return view('laporan-analisis.analisis-kinerja', compact(
            'daftarTerapis',
            'totalTerapis',
            'totalAnak',
            'totalSesi',
            'terapisTerbaik',
            'namaTerapis',
            'jumlahAnak',
            'maxAnak',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }
}
