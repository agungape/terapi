<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Terapis;
use Carbon\Carbon;
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
        // Parse tanggal dengan Carbon (termasuk waktu)
        $tanggalMulai = $request->tanggal_mulai
            ? Carbon::parse($request->tanggal_mulai)->startOfDay()
            : now()->startOfMonth();

        $tanggalSelesai = $request->tanggal_selesai
            ? Carbon::parse($request->tanggal_selesai)->endOfDay()
            : now()->endOfMonth();

        // Query utama untuk menghitung TOTAL KUNJUNGAN (bukan anak unik)
        $daftarTerapis = Terapis::select([
            'terapis.id',
            'terapis.nama',
            'terapis.role',
            DB::raw('COUNT(kunjungans.id) as total_kunjungan') // Hitung semua kunjungan
        ])
            ->leftJoin('kunjungans', function ($join) use ($tanggalMulai, $tanggalSelesai) {
                $join->on('terapis.id', '=', 'kunjungans.terapis_id')
                    ->whereBetween('kunjungans.created_at', [$tanggalMulai, $tanggalSelesai])
                    ->where('kunjungans.status', 'hadir')
                    ->whereNotNull('pertemuan')
                    ->whereNull('catatan');
            })
            ->groupBy('terapis.id', 'terapis.nama', 'terapis.role')
            ->orderBy('total_kunjungan', 'desc')
            ->paginate(10);

        // Total terapis
        $totalTerapis = Terapis::count();

        // Total kunjungan dalam periode (semua terapis)
        $totalKunjungan = Kunjungan::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->where('status', 'hadir')
            ->whereNotNull('pertemuan')
            ->whereNull('catatan')
            ->count();

        // Terapis dengan kunjungan terbanyak
        $terapisTerbaik = Terapis::select([
            'terapis.id',
            'terapis.nama',
            DB::raw('COUNT(kunjungans.id) as total_kunjungan')
        ])
            ->leftJoin('kunjungans', function ($join) use ($tanggalMulai, $tanggalSelesai) {
                $join->on('terapis.id', '=', 'kunjungans.terapis_id')
                    ->whereBetween('kunjungans.created_at', [$tanggalMulai, $tanggalSelesai])
                    ->where('kunjungans.status', 'hadir')
                    ->whereNotNull('pertemuan')
                    ->whereNull('catatan');
            })
            ->groupBy('terapis.id', 'terapis.nama')
            ->orderBy('total_kunjungan', 'desc')
            ->first();

        // Data untuk chart
        $namaTerapis = $daftarTerapis->pluck('nama');
        $totalKunjunganPerTerapis = $daftarTerapis->pluck('total_kunjungan');
        $maxKunjungan = $totalKunjunganPerTerapis->max() ?: 1; // Hindari division by zero

        return view('laporan-analisis.analisis-kinerja', compact(
            'daftarTerapis',
            'totalTerapis',
            'totalKunjungan',
            'terapisTerbaik',
            'namaTerapis',
            'totalKunjunganPerTerapis',
            'maxKunjungan',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }
}
