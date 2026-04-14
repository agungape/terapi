<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Barang;
use App\Models\Detail_transaksi;
use App\Models\Province;
use App\Models\Terapis;
use App\Models\Upload;
use App\Models\User;
use App\Models\Kunjungan;
use App\Models\Pemasukkan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = now();
        $anakCount = Anak::count();
        $terapisCount = Terapis::count();
        $userCount = User::count();

        // 1. Dynamic Greeting
        $hour = $now->hour;
        $greeting = 'Selamat Malam';
        if ($hour >= 5 && $hour < 11) $greeting = 'Selamat Pagi';
        elseif ($hour >= 11 && $hour < 15) $greeting = 'Selamat Siang';
        elseif ($hour >= 15 && $hour < 18) $greeting = 'Selamat Sore';

        // 2. Sesi Hari Ini
        $todaySessionsCount = Kunjungan::whereDate('created_at', today())->count();

        // 3. Pertumbuhan Pasien (Bulan ini vs Bulan Lalu)
        $newPatientsThisMonth = Anak::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();
        
        $newPatientsLastMonth = Anak::whereMonth('created_at', $now->subMonth()->month)
            ->whereYear('created_at', $now->year)
            ->count();
            
        $growthPercentage = $newPatientsLastMonth > 0 
            ? round((($newPatientsThisMonth - $newPatientsLastMonth) / $newPatientsLastMonth) * 100) 
            : 100;

        // 4. Distribusi Gender
        $genderStats = Anak::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        // 5. Statistik Paket Menipis (Sisa 0 - 2 Sesi pada Paket Terbaru)
        $lowQuotaPackages = Pemasukkan::with(['anak', 'tarif'])
            ->where('jenis_layanan', 'paket_terapi')
            ->whereNotNull('tarif_id')
            ->whereNotNull('anak_id')
            ->latest()
            ->get()
            // Mengelompokkan berdasarkan kombinasi anak & jenis terapi untuk mendapatkan kwitansi TERBARU saja
            ->groupBy(fn($p) => $p->anak_id . '-' . $p->tarif_id)
            ->map(fn($group) => $group->first())
            ->filter(function($p) {
                // Hanya ambil yang benar-benar sisa sedikit (0, 1, atau 2)
                return $p->sisa_pertemuan !== null && $p->sisa_pertemuan <= 2;
            })
            ->values();

        // Standardisasi genderStats agar selalu memiliki key L dan P
        $genderStats = array_merge(['L' => 0, 'P' => 0], $genderStats);

        // 6. Sparkline Data (7 Hari Terakhir)
        $sparklineAnak = [];
        $sparklineRevenue = [];
        $sparklineVisit = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = now()->subDays($i)->toDateString();
            $sparklineAnak[] = Anak::whereDate('created_at', $d)->count();
            $sparklineVisit[] = Kunjungan::whereDate('created_at', $d)->count();
            $sparklineRevenue[] = (float) Pemasukkan::whereDate('tanggal', $d)->sum('jumlah');
        }

        // 7. Tren Kunjungan (14 Hari Terakhir)
        $visitTrends = [];
        $visitLabels = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $visitLabels[] = $date->format('d/m');
            $visitTrends[] = Kunjungan::whereDate('created_at', $date->toDateString())->count();
        }

        // 8. Aktivitas Terbaru
        $recentVisits = Kunjungan::with(['anak', 'terapis'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($v) {
                $v->type = 'visit';
                return $v;
            });

        $recentPayments = Pemasukkan::with(['anak'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($p) {
                $p->type = 'payment';
                return $p;
            });

        $recentActivities = $recentVisits->concat($recentPayments)
            ->sortByDesc('created_at')
            ->take(6);

        // 9. Data Grafik Pendapatan (6 Bulan Terakhir)
        $months = [];
        $revenuePerilaku = [];
        $revenueFisio = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $months[] = $monthDate->translatedFormat('F');

            $revenuePerilaku[] = Pemasukkan::whereMonth('tanggal', $monthDate->month)
                ->whereYear('tanggal', $monthDate->year)
                ->where('jenis_layanan', 'paket_terapi')
                ->whereHas('tarif', function($q) { $q->where('jenis_terapi', 'terapi_perilaku'); })
                ->sum('jumlah');

            $revenueFisio[] = Pemasukkan::whereMonth('tanggal', $monthDate->month)
                ->whereYear('tanggal', $monthDate->year)
                ->where('jenis_layanan', 'paket_terapi')
                ->whereHas('tarif', function($q) { $q->where('jenis_terapi', 'fisioterapi'); })
                ->sum('jumlah');
        }

        return view('home', [
            'greeting' => $greeting,
            'anak' => $anakCount,
            'terapis' => $terapisCount,
            'user' => $userCount,
            'todaySessions' => $todaySessionsCount,
            'newPatients' => $newPatientsThisMonth,
            'growth' => $growthPercentage,
            'genderStats' => $genderStats,
            'lowQuotaPackages' => $lowQuotaPackages,
            'recentActivities' => $recentActivities,
            'sparklines' => [
                'anak' => $sparklineAnak,
                'revenue' => $sparklineRevenue,
                'visit' => $sparklineVisit
            ],
            'chartData' => [
                'labels' => $months,
                'revenuePerilaku' => $revenuePerilaku,
                'revenueFisio' => $revenueFisio
            ],
            'visitTrendData' => [
                'labels' => $visitLabels,
                'data' => $visitTrends
            ]
        ]);
    }
}
