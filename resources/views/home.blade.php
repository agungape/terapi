@extends('layouts.master')
@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-10 animate-in fade-in slide-in-from-bottom-4 duration-700"
     x-data="{ 
        chartType: 'revenue',
        initCounters() {
            // Logic for pre-animating counters if needed
        }
     }">
    
    <!-- Ultra-Premium Header: Greeting & Pulse -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-red-50 text-red-600 rounded-full border border-red-100 mb-2">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
                <span class="text-[9px] font-black uppercase tracking-widest italic">Clinical System Live</span>
            </div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight italic">{{ $greeting }}, <span class="text-red-500">{{ explode(' ', auth()->user()->name)[0] }}!</span></h1>
            <p class="text-sm font-medium text-slate-500">Berikut adalah ringkasan performa dan aktivitas klinis hari ini.</p>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="hidden lg:flex flex-col items-end">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Growth vs Last Month</span>
                <div class="flex items-center gap-2">
                    <span class="text-lg font-black {{ $growth >= 0 ? 'text-emerald-500' : 'text-red-500' }}">{{ $growth >= 0 ? '+' : '' }}{{ $growth }}%</span>
                    <i data-lucide="{{ $growth >= 0 ? 'trending-up' : 'trending-down' }}" class="w-4 h-4 {{ $growth >= 0 ? 'text-emerald-500' : 'text-red-500' }}"></i>
                </div>
            </div>
            <div class="h-10 w-px bg-slate-200 mx-2 hidden lg:block"></div>
            <button onclick="location.reload()" class="bg-white border border-slate-200 hover:border-red-500 hover:text-red-600 p-3 rounded-2xl transition-all shadow-sm group">
                <i data-lucide="refresh-cw" class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500"></i>
            </button>
        </div>
    </div>
    
    <!-- Hero Metric Grid: Glassmorphism + Sparklines -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Metric 1: Total Patients -->
        <div class="card-premium p-0 group overflow-hidden relative">
            <div class="p-6 pb-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-slate-900 text-white rounded-2xl shadow-xl shadow-slate-200 group-hover:scale-110 transition-transform">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Active Database</span>
                </div>
                <div x-data="{ count: 0, target: {{ $anak }} }" x-init="setTimeout(() => { let interval = setInterval(() => { if(count < target) { count += Math.ceil(target/20); if(count > target) count = target; } else { clearInterval(interval); } }, 30) }, 500)">
                    <h3 class="text-4xl font-black text-slate-800 tracking-tighter" x-text="count">0</h3>
                    <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-tight">Total Anak Terdaftar</p>
                </div>
            </div>
            <div class="h-16 w-full px-1">
                <canvas id="sparklineAnak"></canvas>
            </div>
        </div>

        <!-- Metric 2: Today Sessions -->
        <div class="card-premium p-0 group overflow-hidden relative">
            <div class="p-6 pb-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-500 text-white rounded-2xl shadow-xl shadow-blue-100 group-hover:scale-110 transition-transform">
                        <i data-lucide="calendar-check" class="w-6 h-6"></i>
                    </div>
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Operational Today</span>
                </div>
                <div x-data="{ count: 0, target: {{ $todaySessions }} }" x-init="setTimeout(() => { let interval = setInterval(() => { if(count < target) { count += 1; } else { clearInterval(interval); } }, 100) }, 700)">
                    <h3 class="text-4xl font-black text-slate-800 tracking-tighter" x-text="count">0</h3>
                    <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-tight">Sesi Terapi Berjalan</p>
                </div>
            </div>
            <div class="h-16 w-full px-1">
                <canvas id="sparklineVisit"></canvas>
            </div>
        </div>

        <!-- Metric 3: Monthly Revenue -->
        <div class="card-premium p-0 group overflow-hidden relative">
            <div class="p-6 pb-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-emerald-500 text-white rounded-2xl shadow-xl shadow-emerald-100 group-hover:scale-110 transition-transform">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Financial Health</span>
                </div>
                @php $mtdRevenue = (collect($chartData['revenuePerilaku'])->last() ?? 0) + (collect($chartData['revenueFisio'])->last() ?? 0); @endphp
                <div x-data="{ count: 0, target: {{ $mtdRevenue }} }" x-init="setTimeout(() => { let interval = setInterval(() => { if(count < target) { count += Math.ceil(target/15); if(count > target) count = target; } else { clearInterval(interval); } }, 40) }, 900)">
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter">Rp <span x-text="count.toLocaleString('id-ID')">0</span></h3>
                    <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-tight">Pendapatan Bulan Ini</p>
                </div>
            </div>
            <div class="h-16 w-full px-1">
                <canvas id="sparklineRevenue"></canvas>
            </div>
        </div>

        <!-- Metric 4: Low Quota Alerts -->
        @if(count($lowQuotaPackages) > 0)
        <div class="card-premium p-6 group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 bg-gradient-to-br from-red-500 to-red-600 text-white border-none shadow-xl shadow-red-100 relative overflow-hidden animate-pulse">
            <i data-lucide="alert-circle" class="absolute -right-4 -bottom-4 w-32 h-32 text-white/10 rotate-12"></i>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-2 bg-white/20 backdrop-blur-md rounded-xl">
                        <i data-lucide="bell-ring" class="w-6 h-6"></i>
                    </div>
                    <span class="text-[9px] font-black text-white/70 uppercase tracking-widest">High Priority</span>
                </div>
                <h3 class="text-4xl font-black tracking-tighter italic">{{ count($lowQuotaPackages) }}</h3>
                <p class="text-xs font-bold text-white/80 mt-1 uppercase tracking-tight">Paket Hampir Habis</p>
                <div class="mt-6">
                    <a href="#quota-list" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest bg-white/20 hover:bg-white/30 px-4 py-2 rounded-xl transition-all">
                        Tindak Lanjut <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="card-premium p-6 group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white border-none shadow-xl shadow-emerald-100 relative overflow-hidden">
            <i data-lucide="check-circle" class="absolute -right-4 -bottom-4 w-32 h-32 text-white/10 rotate-12"></i>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-2 bg-white/20 backdrop-blur-md rounded-xl">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <span class="text-[9px] font-black text-white/70 uppercase tracking-widest">System Clear</span>
                </div>
                <h3 class="text-xl font-black tracking-widest italic uppercase">Semua Aman</h3>
                <p class="text-xs font-bold text-white/80 mt-1 uppercase tracking-tight">Belum Ada Paket Menipis</p>
                <div class="mt-6">
                    <a href="{{ route('keuangan.pemasukkan') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest bg-white/20 hover:bg-white/30 px-4 py-2 rounded-xl transition-all">
                        Data Utama <i data-lucide="external-link" class="w-3 h-3"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Analytics & Insight Row -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Big Charts: Revenue & Demographics -->
        <div class="lg:col-span-8 space-y-8">
            <div class="card-premium p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                    <div class="space-y-1">
                        <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight flex items-center gap-2">
                             ANALISIS KEUANGAN KLINIS
                        </h3>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Laporan Pendapatan Layanan (6 Bulan Terakhir)</p>
                    </div>
                    <div class="flex items-center p-1.5 bg-slate-50 border border-slate-100 rounded-2xl gap-2">
                        <button 
                            @click="chartType = 'revenue'"
                            :class="chartType === 'revenue' ? 'bg-white text-slate-800 shadow-sm border-slate-200' : 'text-slate-400 border-transparent'"
                            class="px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-xl border transition-all">Revenue</button>
                        <button 
                            @click="chartType = 'visits'"
                            :class="chartType === 'visits' ? 'bg-white text-slate-800 shadow-sm border-slate-200' : 'text-slate-400 border-transparent'"
                            class="px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-xl border transition-all">Visits</button>
                    </div>
                </div>
                <div class="h-[400px]">
                    <div x-show="chartType === 'revenue'" x-transition class="h-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                    <div x-show="chartType === 'visits'" x-transition class="h-full">
                        <canvas id="mainVisitChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 p-12 opacity-10">
                    <i data-lucide="trending-up" class="w-48 h-48"></i>
                </div>
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-2 space-y-4">
                        <h3 class="text-xl font-black uppercase italic tracking-tight">Tren Kunjungan Pasien</h3>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Visualisasi distribusi kedatangan harian selama 14 hari terakhir untuk optimalisasi jadwal terapis.</p>
                        <div class="pt-4 h-[200px]">
                            <canvas id="visitTrendChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white/5 backdrop-blur-md rounded-[2.5rem] p-8 border border-white/10 flex flex-col items-center justify-center text-center">
                        <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-2">Beban Harian Rata-rata</p>
                        <h2 class="text-4xl font-black italic tracking-tighter mb-4">{{ round(collect($visitTrendData['data'])->avg(), 1) }}</h2>
                        <span class="text-xs font-bold text-slate-400 uppercase">Pasien / Hari</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Widgets: Demographics & Activity -->
        <div class="lg:col-span-4 space-y-8">
            <div class="card-premium p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-[11px] font-black text-slate-800 uppercase tracking-widest italic">Demografi Pasien</h3>
                    <i data-lucide="pie-chart" class="w-4 h-4 text-slate-300"></i>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-56 h-56 relative">
                        <canvas id="genderChart"></canvas>
                    </div>
                    <div class="w-full mt-10 space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50/50 rounded-2xl border border-blue-100/50 group hover:bg-blue-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.6)]"></div>
                                <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Laki-laki</span>
                            </div>
                            <span class="text-sm font-black text-slate-800">{{ $genderStats['L'] ?? 0 }} Anak</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-pink-50/50 rounded-2xl border border-pink-100/50 group hover:bg-pink-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-pink-500 shadow-[0_0_10px_rgba(236,72,153,0.4)]"></div>
                                <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Perempuan</span>
                            </div>
                            <span class="text-sm font-black text-slate-800">{{ $genderStats['P'] }} Anak</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Stream: Bento Design -->
            <div class="card-premium overflow-hidden border-none shadow-2xl">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/50 backdrop-blur-md">
                    <h3 class="text-[11px] font-black text-slate-800 uppercase tracking-widest italic flex items-center gap-2">
                        <i data-lucide="rss" class="w-4 text-red-500"></i> AKTIVITAS REAL-TIME
                    </h3>
                    <span class="text-[8px] font-black text-slate-400 bg-white px-2 py-1 rounded-lg border border-slate-100 tracking-widest uppercase animate-pulse">Live</span>
                </div>
                <div class="p-0 scrollbar-hide max-h-[440px] overflow-y-auto">
                    @forelse($recentActivities as $activity)
                    <a href="{{ $activity->type == 'visit' ? route('kunjungan.index') : route('keuangan.pemasukkan') }}" class="block p-6 border-b border-slate-50 hover:bg-slate-50/80 transition-all group">
                        <div class="flex gap-4">
                            <div class="shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center transition-all group-hover:scale-110 {{ $activity->type == 'visit' ? 'bg-blue-50 text-blue-500 shadow-lg shadow-blue-50/50' : 'bg-emerald-50 text-emerald-500 shadow-lg shadow-emerald-50/50' }}">
                                <i data-lucide="{{ $activity->type == 'visit' ? 'user-check' : 'credit-card' }}" class="w-6 h-6"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="text-xs font-black text-slate-800 uppercase italic truncate">{{ $activity->anak->nama }}</h4>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase italic">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-[10px] font-bold text-slate-400 line-clamp-1 uppercase tracking-tight">
                                    {{ $activity->type == 'visit' ? 'Sesi ' . str_ireplace('_', ' ', $activity->jenis_terapi) : 'Pembayaran ' . str_ireplace('_', ' ', $activity->jenis_layanan) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="p-20 text-center space-y-3">
                        <i data-lucide="inbox" class="w-12 h-12 text-slate-100 mx-auto"></i>
                        <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada aktivitas baru</p>
                    </div>
                    @endforelse
                </div>
            </div>
    </div>

    <!-- 4. Priority Quota List -->
    @if(count($lowQuotaPackages) > 0)
    <div id="quota-list" class="space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight">Daftar Paket Menipis (≤ 2 Sesi)</h3>
            <span class="px-4 py-1.5 bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-red-200">{{ count($lowQuotaPackages) }} Perlu Tindakan</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($lowQuotaPackages as $pkg)
            <div class="card-premium p-6 hover:shadow-2xl transition-all group border-l-4 border-l-red-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h4 class="text-sm font-black text-slate-800 uppercase italic">{{ $pkg->anak->nama }}</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">{{ str_ireplace('_', ' ', $pkg->tarif->nama_tarif) }}</p>
                    </div>
                    <div class="bg-red-50 text-red-600 px-3 py-1 rounded-lg text-[11px] font-black border border-red-100">
                        {{ $pkg->sisa_pertemuan }} Sesi
                    </div>
                </div>
                <div class="flex gap-3">
                    @php
                        $phone = $pkg->anak->telepon_ibu ?? $pkg->anak->telepon_ayah ?? '';
                        $formattedPhone = preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $phone));
                        $waMsg = "Halo Bapak/Ibu, menginfokan jatah terapi " . $pkg->anak->nama . " sisa " . $pkg->sisa_pertemuan . " sesi lagi. Mohon segera melakukan perpanjangan paket. Terima kasih.";
                    @endphp
                    <a href="https://wa.me/{{ $formattedPhone }}?text={{ urlencode($waMsg) }}" target="_blank" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-sm">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="{{ route('anak.show', $pkg->anak_id) }}" class="px-4 bg-slate-50 hover:bg-slate-100 text-slate-600 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        Profil
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { enabled: false } },
            scales: { x: { display: false }, y: { display: false } },
            elements: { point: { radius: 0 } }
        };

        // 1. Sparklines for Hero Metrics
        const sparklineData = @json($sparklines);
        
        // Template for sparks
        const createSpark = (id, data, color) => {
            const ctx = document.getElementById(id).getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [1,2,3,4,5,6,7],
                    datasets: [{
                        data: data,
                        borderColor: color,
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4
                    }]
                },
                options: commonOptions
            });
        };

        createSpark('sparklineAnak', sparklineData.anak, '#1e293b');
        createSpark('sparklineVisit', sparklineData.visit, '#3b82f6');
        createSpark('sparklineRevenue', sparklineData.revenue, '#10b981');

        // 2. Main Revenue Chart
        const revCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueData = @json($chartData);
        
        const blueGrad = revCtx.createLinearGradient(0, 0, 0, 400);
        blueGrad.addColorStop(0, '#3b82f6'); blueGrad.addColorStop(1, '#93c5fd');

        const redGrad = revCtx.createLinearGradient(0, 0, 0, 400);
        redGrad.addColorStop(0, '#ef4444'); redGrad.addColorStop(1, '#fca5a5');

        new Chart(revCtx, {
            type: 'bar',
            data: {
                labels: revenueData.labels,
                datasets: [
                    { label: 'Perilaku', data: revenueData.revenuePerilaku, backgroundColor: blueGrad, borderRadius: 12, barPercentage: 0.6 },
                    { label: 'Fisio & SI', data: revenueData.revenueFisio, backgroundColor: redGrad, borderRadius: 12, barPercentage: 0.6 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleFont: { family: 'Plus Jakarta Sans', size: 12, weight: 800 },
                        bodyFont: { family: 'Plus Jakarta Sans', size: 12, weight: 600 },
                        padding: 16,
                        cornerRadius: 16,
                        displayColors: false,
                        callbacks: { label: (c) => 'Rp ' + c.parsed.y.toLocaleString('id-ID') }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { weight: 800, size: 10 }, color: '#94a3b8' } },
                    y: { grid: { color: '#f1f5f9', borderDash: [5, 5] }, ticks: { font: { weight: 700, size: 9 }, callback: v => v/1000000 + 'M' } }
                }
            }
        });

        // 2.1 Duplicate Revenue into a dedicated Visits Bar Chart for the toggle
        const visitCtx = document.getElementById('mainVisitChart').getContext('2d');
        new Chart(visitCtx, {
            type: 'bar',
            data: {
                labels: revenueData.labels,
                datasets: [
                    { label: 'Volume Sesi', data: @json($visitTrendData['data']).slice(-6), backgroundColor: '#3b82f6', borderRadius: 12, barPercentage: 0.6 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { weight: 800, size: 10 }, color: '#94a3b8' } },
                    y: { grid: { color: '#f1f5f9', borderDash: [5, 5] }, ticks: { font: { weight: 700, size: 9 } } }
                }
            }
        });

        // 3. Visit Trend Line Chart (Dark Theme)
        const trendCtx = document.getElementById('visitTrendChart').getContext('2d');
        const trendData = @json($visitTrendData);
        const tGrad = trendCtx.createLinearGradient(0, 0, 0, 200);
        tGrad.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
        tGrad.addColorStop(1, 'rgba(59, 130, 246, 0)');

        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: trendData.labels,
                datasets: [{
                    data: trendData.data,
                    borderColor: '#3b82f6',
                    borderWidth: 4,
                    fill: true,
                    backgroundColor: tGrad,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#3b82f6',
                    pointHoverBorderWidth: 4
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#64748b', font: { size: 9, weight: 800 } } },
                    y: { display: false }
                }
            }
        });

        // 4. Gender Doughnut
        const gCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(gCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $genderStats['L'] ?? 0 }}, {{ $genderStats['P'] ?? 0 }}],
                    backgroundColor: ['#3b82f6', '#ec4899'],
                    borderWidth: 0,
                    hoverOffset: 12
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '82%',
                plugins: { legend: { display: false } }
            }
        });
    });
</script>
@endsection
