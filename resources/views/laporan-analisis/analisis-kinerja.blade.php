@extends('layouts.master')
@section('title', 'Analisis Kinerja Terapis')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-primary-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Laporan Analisis</span>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Kinerja Terapis</span>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="px-4 py-2 bg-white rounded-xl border border-slate-200 shadow-sm flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Live Analysis</span>
            </div>
        </div>
    </div>

    <!-- Filter Header -->
    <div class="card-premium p-8 bg-white border-none shadow-xl shadow-slate-200/50">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-primary-50 text-primary-500 rounded-2xl">
                    <i data-lucide="filter" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-base font-black text-slate-800 uppercase tracking-tight leading-none mb-1">Filter Kinerja</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pilih periode analisis untuk melihat statistik</p>
                </div>
            </div>

            <form method="GET" action="" class="flex flex-wrap items-end gap-4">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" 
                           class="bg-slate-50 border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-primary-50 transition-all"
                           value="{{ request('tanggal_mulai', now()->startOfMonth()->format('Y-m-d')) }}"
                           max="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" 
                           class="bg-slate-50 border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-primary-50 transition-all"
                           value="{{ request('tanggal_selesai', now()->endOfMonth()->format('Y-m-d')) }}"
                           max="{{ now()->format('Y-m-d') }}">
                </div>
                <button type="submit" class="bg-slate-900 hover:bg-primary-500 text-white px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all flex items-center gap-2 shadow-lg shadow-slate-200">
                    <i data-lucide="search" class="w-4 h-4"></i> Apply Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card-premium p-6 bg-white flex items-center gap-5 group hover:border-red-100 transition-all">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0 group-hover:bg-blue-500 group-hover:text-white transition-all">
                <i data-lucide="user-cog" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Terapis</p>
                <h3 class="text-xl font-black text-slate-800">{{ $totalTerapis }}</h3>
            </div>
        </div>

        <div class="card-premium p-6 bg-white flex items-center gap-5 group hover:border-red-100 transition-all">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                <i data-lucide="calendar-check" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Kunjungan</p>
                <h3 class="text-xl font-black text-slate-800">{{ $totalKunjungan }}</h3>
            </div>
        </div>

        <div class="card-premium p-6 bg-white flex items-center gap-5 group hover:border-red-100 transition-all">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0 group-hover:bg-amber-500 group-hover:text-white transition-all">
                <i data-lucide="gauge" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Rata-rata / Terapis</p>
                <h3 class="text-xl font-black text-slate-800">{{ $totalTerapis > 0 ? round($totalKunjungan / $totalTerapis, 1) : 0 }}</h3>
            </div>
        </div>

        <div class="card-premium p-6 bg-slate-900 text-white relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Terapis Terbaik</p>
                <h3 class="text-sm font-black text-white truncate pr-2 uppercase italic tracking-tight">
                    {{ $terapisTerbaik->nama ?? '-' }}
                </h3>
                <div class="flex items-center gap-2 mt-2">
                    <span class="px-2 py-0.5 bg-primary-500 text-white rounded text-[9px] font-black uppercase tracking-widest">
                        {{ $terapisTerbaik->total_kunjungan ?? 0 }} Kunjungan
                    </span>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-white/5 group-hover:text-white/10 transition-colors">
                <i data-lucide="star" class="w-24 h-24"></i>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8">
            <div class="card-premium bg-white h-full">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="bar-chart-3" class="w-4 h-4 text-red-500"></i> Distribusi Kunjungan
                    </h3>
                </div>
                <div class="p-8">
                    <div class="relative h-[400px]">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4">
            <div class="card-premium bg-white h-full">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="pie-chart" class="w-4 h-4 text-red-500"></i> Beban Kerja %
                    </h3>
                </div>
                <div class="p-8">
                    <div class="relative h-[300px]">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <div class="mt-8 space-y-3">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic leading-relaxed text-center">
                            Dataset dihitung berdasarkan total rekapan kunjungan yang tercatat dalam sistem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
        <div class="p-6 border-b border-slate-50 bg-white flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="list" class="w-4 h-4 text-red-500"></i> DAFTAR PERFORMA TERAPIS
            </h3>
            <div class="relative group">
                <i data-lucide="search" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-red-500 transition-colors"></i>
                <input type="text" id="searchInput" 
                       class="bg-slate-50 border-none rounded-xl pl-9 pr-4 py-2 text-[10px] font-bold text-slate-600 outline-none focus:ring-4 focus:ring-red-50 transition-all w-48"
                       placeholder="Cari Terapis...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Terapis</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Spesialisasi</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Kunjungan</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Efficiency Progress</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($daftarTerapis as $index => $terapis)
                    <tr class="hover:bg-slate-50/50 transition-colors group/row">
                        <td class="px-6 py-5 text-xs font-black text-slate-300 italic">{{ $daftarTerapis->firstItem() + $index }}</td>
                        <td class="px-6 py-5">
                            <span class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $terapis->nama }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-slate-200">{{ $terapis->role }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-black text-slate-800">{{ $terapis->total_kunjungan }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Sessions</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            @php 
                                $percent = $maxKunjungan > 0 ? ($terapis->total_kunjungan / $maxKunjungan) * 100 : 0;
                                $colorClass = $percent > 70 ? 'bg-emerald-500' : ($percent > 40 ? 'bg-amber-500' : 'bg-primary-500');
                            @endphp
                            <div class="space-y-1.5 min-w-[120px]">
                                <div class="flex items-center justify-between text-[9px] font-black uppercase tracking-widest italic">
                                    <span class="text-slate-400">Yield</span>
                                    <span class="text-slate-800">{{ round($percent, 1) }}%</span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="{{ $colorClass }} h-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center">
                                <a href="{{ route('terapis.show', $terapis->id) }}" 
                                   class="p-2 bg-slate-900 text-white rounded-xl hover:bg-primary-500 transition-all shadow-lg shadow-slate-200" title="Detail Performa">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $daftarTerapis->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // Common Chart Defaults
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.font.size = 11;
        Chart.defaults.color = '#94a3b8';

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        const namaTerapis = {!! json_encode($namaTerapis) !!};
        const totalKunjungan = {!! json_encode($totalKunjunganPerTerapis) !!};

        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: namaTerapis,
                datasets: [{
                    label: 'Total Sesi Kunjungan',
                    data: totalKunjungan,
                    backgroundColor: window.primaryColor,
                    borderColor: window.primaryColor,
                    borderWidth: 0,
                    borderRadius: 8,
                    maxBarThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#f1f5f9' },
                        ticks: { stepSize: 1 }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: namaTerapis,
                datasets: [{
                    data: totalKunjungan,
                    backgroundColor: [
                        '#0f172a', window.primaryColor, '#10b981', '#f59e0b', '#3b82f6', 
                        '#6366f1', '#a855f7', '#ec4899', '#14b8a6', '#f97316'
                    ],
                    borderWidth: 4,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 9, weight: 'bold' }
                        }
                    }
                }
            }
        });

        // Client-side search
        $('#searchInput').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection
