<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Assessment;
use App\Models\Jadwal;
use App\Models\Kategori;
use App\Models\Kunjungan;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use App\Models\SaldoKas;
use App\Models\Tarif;
use App\Models\Terapis;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super-admin']);
    }

    public function dashboard(Request $request)
    {
        $now   = Carbon::now();
        $today = $now->toDateString();

        // =========================================================
        // 1. STATISTIK GLOBAL
        // =========================================================
        $totalAnak    = Anak::count();
        $anakAktif    = Anak::where('status', 'aktif')->count();
        $anakNonAktif = Anak::where('status', '!=', 'aktif')->count();
        $totalTerapis = Terapis::where('status', 'aktif')->count();
        $totalUser    = User::count();

        // Anak baru bulan ini
        $anakBulanIni   = Anak::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->count();
        $anakBulanLaluM = $now->copy()->subMonth();
        $anakBulanLalu  = Anak::whereYear('created_at', $anakBulanLaluM->year)->whereMonth('created_at', $anakBulanLaluM->month)->count();

        // Distribusi gender anak
        $genderStats = Anak::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')->get()->pluck('total', 'jenis_kelamin')->toArray();
        $genderStats = array_merge(['L' => 0, 'P' => 0], $genderStats);

        // =========================================================
        // 2. SALDO KAS REAL
        // =========================================================
        $saldoKas    = SaldoKas::first();
        $saldoKasRaw = $saldoKas ? (float) $saldoKas->getRawOriginal('saldo_awal') : 0;

        // =========================================================
        // 3. KEUANGAN — BULAN INI & MINGGU INI
        // =========================================================
        $pemasukkanBulanIni = (float) Pemasukkan::whereYear('tanggal', $now->year)
            ->whereMonth('tanggal', $now->month)->sum('jumlah');

        $pengeluaranBulanIni = (float) Pengeluaran::whereYear('tanggal', $now->year)
            ->whereMonth('tanggal', $now->month)->sum('jumlah');

        $startWeek = $now->copy()->startOfWeek(Carbon::MONDAY)->toDateString();
        $endWeek   = $now->copy()->endOfWeek(Carbon::SUNDAY)->toDateString();

        $pemasukkanMingguIni  = (float) Pemasukkan::whereBetween('tanggal', [$startWeek, $endWeek])->sum('jumlah');
        $pengeluaranMingguIni = (float) Pengeluaran::whereBetween('tanggal', [$startWeek, $endWeek])->sum('jumlah');

        // Pemasukkan HARI INI
        $pemasukkanHariIni  = (float) Pemasukkan::whereDate('tanggal', $today)->sum('jumlah');
        $pengeluaranHariIni = (float) Pengeluaran::whereDate('tanggal', $today)->sum('jumlah');

        // Bulan Lalu
        $lastMonth = $now->copy()->subMonth();
        $pemasukkanBulanLalu  = (float) Pemasukkan::whereYear('tanggal', $lastMonth->year)->whereMonth('tanggal', $lastMonth->month)->sum('jumlah');
        $pengeluaranBulanLalu = (float) Pengeluaran::whereYear('tanggal', $lastMonth->year)->whereMonth('tanggal', $lastMonth->month)->sum('jumlah');

        $growthPemasukkan = $pemasukkanBulanLalu > 0
            ? round((($pemasukkanBulanIni - $pemasukkanBulanLalu) / $pemasukkanBulanLalu) * 100, 1)
            : ($pemasukkanBulanIni > 0 ? 100 : 0);
        $growthPengeluaran = $pengeluaranBulanLalu > 0
            ? round((($pengeluaranBulanIni - $pengeluaranBulanLalu) / $pengeluaranBulanLalu) * 100, 1)
            : ($pengeluaranBulanIni > 0 ? 100 : 0);

        $totalPemasukkan  = (float) Pemasukkan::sum('jumlah');
        $totalPengeluaran = (float) Pengeluaran::sum('jumlah');
        $saldoBersih      = $totalPemasukkan - $totalPengeluaran;
        $saldoBulanIni    = $pemasukkanBulanIni - $pengeluaranBulanIni;

        // Metode bayar bulan ini
        $metodeBayar = Pemasukkan::select('metode_bayar', DB::raw('COUNT(*) as total, SUM(jumlah) as nominal'))
            ->whereYear('tanggal', $now->year)->whereMonth('tanggal', $now->month)
            ->whereNotNull('metode_bayar')
            ->groupBy('metode_bayar')->get();

        // =========================================================
        // 4. CHART BULANAN (12 bulan terakhir)
        // =========================================================
        $chartBulananLabels = $chartBulananPemasukkan = $chartBulananPengeluaran = [];
        for ($i = 11; $i >= 0; $i--) {
            $m = $now->copy()->subMonths($i);
            $chartBulananLabels[]      = $m->translatedFormat('M Y');
            $chartBulananPemasukkan[]  = (float) Pemasukkan::whereYear('tanggal', $m->year)->whereMonth('tanggal', $m->month)->sum('jumlah');
            $chartBulananPengeluaran[] = (float) Pengeluaran::whereYear('tanggal', $m->year)->whereMonth('tanggal', $m->month)->sum('jumlah');
        }

        // =========================================================
        // 5. CHART MINGGUAN (8 minggu terakhir)
        // =========================================================
        $chartMingguanLabels = $chartMingguanPemasukkan = $chartMingguanPengeluaran = [];
        for ($i = 7; $i >= 0; $i--) {
            $ws = $now->copy()->subWeeks($i)->startOfWeek(Carbon::MONDAY);
            $we = $ws->copy()->endOfWeek(Carbon::SUNDAY);
            $chartMingguanLabels[]      = 'Mg ' . $ws->format('d/m');
            $chartMingguanPemasukkan[]  = (float) Pemasukkan::whereBetween('tanggal', [$ws->toDateString(), $we->toDateString()])->sum('jumlah');
            $chartMingguanPengeluaran[] = (float) Pengeluaran::whereBetween('tanggal', [$ws->toDateString(), $we->toDateString()])->sum('jumlah');
        }

        // =========================================================
        // 6. CHART KUNJUNGAN 14 HARI TERAKHIR
        // =========================================================
        $chartKunjunganLabels = $chartKunjunganData = $chartKunjunganHadir = [];
        for ($i = 13; $i >= 0; $i--) {
            $d = $now->copy()->subDays($i)->toDateString();
            $chartKunjunganLabels[] = $now->copy()->subDays($i)->format('d/m');
            $chartKunjunganData[]   = Kunjungan::whereDate('created_at', $d)->count();
            $chartKunjunganHadir[]  = Kunjungan::whereDate('created_at', $d)->where('status', 'hadir')->count();
        }

        // =========================================================
        // 7. RINCIAN PEMASUKKAN PER KATEGORI & JENIS (bulan ini)
        // =========================================================
        $rincianPemasukkan = Pemasukkan::select('kategori_id', DB::raw('SUM(jumlah) as total'))
            ->whereYear('tanggal', $now->year)->whereMonth('tanggal', $now->month)
            ->groupBy('kategori_id')->with('kategori')->get()
            ->map(fn($item) => ['nama' => $item->kategori->nama ?? 'Tanpa Kategori', 'total' => (float) $item->total]);

        $rincianPemasukkanJenisPaket = Pemasukkan::select('jenis_layanan', DB::raw('SUM(jumlah) as total'))
            ->whereYear('tanggal', $now->year)->whereMonth('tanggal', $now->month)
            ->groupBy('jenis_layanan')->get()
            ->map(fn($item) => [
                'nama'  => match ($item->jenis_layanan) {
                    'paket_terapi' => 'Paket Terapi', 'assessment' => 'Assessment', 'lainnya' => 'Lainnya',
                    default => ucfirst($item->jenis_layanan ?? 'Lainnya'),
                },
                'total' => (float) $item->total,
            ]);

        // =========================================================
        // 8. RINCIAN PENGELUARAN PER KATEGORI (bulan ini)
        // =========================================================
        $rincianPengeluaran = Pengeluaran::select('kategori_id', DB::raw('SUM(jumlah) as total'))
            ->whereYear('tanggal', $now->year)->whereMonth('tanggal', $now->month)
            ->groupBy('kategori_id')->with('kategori')->get()
            ->map(fn($item) => ['nama' => $item->kategori->nama ?? 'Tanpa Kategori', 'total' => (float) $item->total]);

        // =========================================================
        // 9. MONITORING KUNJUNGAN HARI INI
        // =========================================================
        $kunjunganStats = Kunjungan::whereDate('created_at', $today)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')->pluck('total', 'status')->toArray();

        $hadirHariIni      = $kunjunganStats['hadir']       ?? 0;
        $sakitHariIni      = $kunjunganStats['sakit']        ?? 0;
        $izinHariIni       = $kunjunganStats['izin']         ?? 0;
        $izinHangusHariIni = $kunjunganStats['izin_hangus']  ?? 0;
        $totalKunjunganHariIni = array_sum($kunjunganStats);

        $semuaKunjunganHariIni = Kunjungan::with(['anak', 'terapis', 'tarif'])
            ->whereDate('created_at', $today)->latest()->get();

        // Kunjungan bulan ini per jenis
        $kunjunganPerJenis = Kunjungan::select('jenis_terapi', DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)
            ->where('status', 'hadir')
            ->groupBy('jenis_terapi')->pluck('total', 'jenis_terapi')->toArray();

        // Total kunjungan bulan ini & perbandingan
        $totalKunjunganBulanIni  = Kunjungan::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->count();
        $totalKunjunganBulanLalu = Kunjungan::whereYear('created_at', $lastMonth->year)->whereMonth('created_at', $lastMonth->month)->count();

        // =========================================================
        // 10. JADWAL HARI INI vs YANG SUDAH HADIR
        // =========================================================
        // Jadwal menyimpan tanggal di format 'Y-m-d' di DB (accessor mengubah ke d-m-Y)
        // Kita query menggunakan DATE() agar aman
        $jadwalHariIni = Jadwal::with(['anak', 'terapis'])
            ->whereRaw("DATE(tanggal) = ?", [$today])
            ->get();

        // Anak yang ada di jadwal hari ini dan sudah hadir
        $jadwalAnakIds = $jadwalHariIni->pluck('anak_id')->unique();
        $sudahHadirDariJadwal = Kunjungan::whereDate('created_at', $today)
            ->where('status', 'hadir')->whereIn('anak_id', $jadwalAnakIds)->pluck('anak_id');

        // Anak yang dijadwalkan tapi BELUM hadir
        $jadwalBelumHadir = $jadwalHariIni->filter(fn($j) => !$sudahHadirDariJadwal->contains($j->anak_id));

        // =========================================================
        // 11. ANAK BELUM DIISI PEMERIKSAAN
        // =========================================================
        $belumPemeriksaan = Kunjungan::with(['anak', 'terapis', 'tarif'])
            ->whereDate('created_at', $today)
            ->where('status', 'hadir')
            ->whereDoesntHave('pemeriksaans')
            ->get();

        // =========================================================
        // 12. ASSESSMENT BELUM BAYAR
        // =========================================================
        $assessmentBelumBayar = Assessment::with(['anak', 'Psikolog'])
            ->where('status_bayar', 'belum_bayar')
            ->latest()->get();

        // Assessment bulan ini
        $assessmentBulanIni  = Assessment::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->count();
        $assessmentLunas     = Assessment::where('status_bayar', 'lunas')->count();
        $assessmentBelumBayarCount = Assessment::where('status_bayar', 'belum_bayar')->orWhereNull('status_bayar')->count();

        // =========================================================
        // 13. KINERJA TERAPIS BULAN INI
        // =========================================================
        $kinerjaTermapis = Terapis::select([
            'terapis.id', 'terapis.nama', 'terapis.role',
            DB::raw('COUNT(kunjungans.id) as total_kunjungan'),
        ])
        ->leftJoin('kunjungans', function ($join) use ($now) {
            $join->on('terapis.id', '=', 'kunjungans.terapis_id')
                ->whereYear('kunjungans.created_at', $now->year)
                ->whereMonth('kunjungans.created_at', $now->month)
                ->where('kunjungans.status', 'hadir');
        })
        ->where('terapis.status', 'aktif')
        ->groupBy('terapis.id', 'terapis.nama', 'terapis.role')
        ->orderByDesc('total_kunjungan')
        ->get();

        // Kunjungan per terapis hari ini
        $kunjunganPerTerapisHariIni = Kunjungan::select('terapis_id', DB::raw('COUNT(*) as total'))
            ->whereDate('created_at', $today)->groupBy('terapis_id')
            ->with('terapis')->get()->keyBy('terapis_id');

        // Top 3 terapis
        $topTerapis = $kinerjaTermapis->take(3);

        // =========================================================
        // 14. MONITORING SISA PERTEMUAN
        // =========================================================
        $allPaket = Pemasukkan::with(['anak', 'tarif'])
            ->where('jenis_layanan', 'paket_terapi')
            ->whereNotNull('tarif_id')->whereNotNull('anak_id')
            ->whereHas('anak', function($q) {
                $q->where('status', 'aktif');
            })
            ->latest()->get();

        $paketPerAnak = $allPaket
            ->groupBy(fn($p) => $p->anak_id . '-' . $p->tarif_id)
            ->map(fn($g) => $g->first())->values();

        $paketMenipis = $paketPerAnak->filter(function ($p) {
            $sisa = $p->sisa_pertemuan;
            return is_array($sisa) ? min($sisa) <= 5 : ($sisa !== null && $sisa <= 5);
        })->values();

        $paketKritis = $paketMenipis->filter(function ($p) {
            $sisa = $p->sisa_pertemuan;
            return is_array($sisa) ? min($sisa) <= 2 : ($sisa !== null && $sisa <= 2);
        })->values();

        $paketAktifSemua = $paketPerAnak->filter(function ($p) {
            $sisa = $p->sisa_pertemuan;
            return is_array($sisa) ? max($sisa) > 0 : ($sisa !== null && $sisa > 0);
        })->values();

        // Sesi selesai bulan ini
        $sesiSelesaiBulanIni = Kunjungan::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)->where('status_sesi', 'selesai')->count();

        // =========================================================
        // 15. STATISTIK ANAK
        // =========================================================
        // Diagnosa terbanyak
        $diagnosaTerbanyak = Anak::select('diagnosa', DB::raw('COUNT(*) as total'))
            ->whereNotNull('diagnosa')->where('diagnosa', '!=', '')
            ->where('status', 'aktif')
            ->groupBy('diagnosa')->orderByDesc('total')->take(5)->get();

        // Anak terdaftar per bulan (6 bulan terakhir)
        $anakPerBulanLabels = $anakPerBulanData = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = $now->copy()->subMonths($i);
            $anakPerBulanLabels[] = $m->translatedFormat('M');
            $anakPerBulanData[]   = Anak::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count();
        }

        // =========================================================
        // 16. TRANSAKSI TERBARU
        // =========================================================
        $pemasukkanTerbaru  = Pemasukkan::with(['anak', 'kategori', 'tarif'])->latest()->take(10)->get();
        $pengeluaranTerbaru = Pengeluaran::with(['kategori'])->latest()->take(10)->get();

        return view('super-admin.dashboard', compact(
            // Global
            'totalAnak', 'anakAktif', 'anakNonAktif', 'totalTerapis', 'totalUser',
            'anakBulanIni', 'anakBulanLalu', 'genderStats',

            // Saldo kas
            'saldoKasRaw',

            // Keuangan
            'pemasukkanBulanIni', 'pengeluaranBulanIni',
            'pemasukkanMingguIni', 'pengeluaranMingguIni',
            'pemasukkanHariIni', 'pengeluaranHariIni',
            'pemasukkanBulanLalu', 'pengeluaranBulanLalu',
            'growthPemasukkan', 'growthPengeluaran',
            'totalPemasukkan', 'totalPengeluaran',
            'saldoBersih', 'saldoBulanIni',
            'metodeBayar',

            // Chart data
            'chartBulananLabels', 'chartBulananPemasukkan', 'chartBulananPengeluaran',
            'chartMingguanLabels', 'chartMingguanPemasukkan', 'chartMingguanPengeluaran',
            'chartKunjunganLabels', 'chartKunjunganData', 'chartKunjunganHadir',

            // Rincian kategori
            'rincianPemasukkan', 'rincianPemasukkanJenisPaket', 'rincianPengeluaran',

            // Kunjungan hari ini
            'hadirHariIni', 'sakitHariIni', 'izinHariIni', 'izinHangusHariIni',
            'totalKunjunganHariIni', 'semuaKunjunganHariIni',
            'kunjunganPerJenis', 'totalKunjunganBulanIni', 'totalKunjunganBulanLalu',

            // Jadwal
            'jadwalHariIni', 'jadwalBelumHadir',

            // Belum pemeriksaan
            'belumPemeriksaan',

            // Assessment
            'assessmentBelumBayar', 'assessmentBulanIni', 'assessmentLunas', 'assessmentBelumBayarCount',

            // Terapis
            'kinerjaTermapis', 'kunjunganPerTerapisHariIni', 'topTerapis',

            // Sisa pertemuan
            'paketMenipis', 'paketKritis', 'paketAktifSemua', 'sesiSelesaiBulanIni',

            // Anak
            'diagnosaTerbanyak', 'anakPerBulanLabels', 'anakPerBulanData',

            // Transaksi terbaru
            'pemasukkanTerbaru', 'pengeluaranTerbaru'
        ));
    }
}
