@extends('layouts.master')
@section('title', 'Rekapitulasi Saldo KAS')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-100 pb-6">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Laporan Keuangan & Rekap Kas</span>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-white rounded-xl border border-slate-200 shadow-sm">
                <i data-lucide="calendar" class="w-4 h-4 text-red-500"></i>
                <span class="text-xs font-black text-slate-600">TAHUN: {{ $selectedYear }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Saldo Kas -->
        <div class="card-premium p-8 bg-white border-l-4 border-l-red-500 relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Saldo Kas Tersedia</p>
                <h3 class="text-3xl font-black text-slate-800 tracking-tighter">
                    {{ $saldoKas ? $saldoKas->saldoawalFormatted : 'Rp 0' }}
                </h3>
                <div class="mt-4 flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-red-50 text-red-600 rounded text-[9px] font-black uppercase tracking-widest">Balance</span>
                    <span class="text-[10px] text-slate-400 font-bold tracking-tight">Per Hari Ini</span>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 text-red-50/50">
                <i data-lucide="wallet" class="w-32 h-32"></i>
            </div>
        </div>

        <!-- Pemasukkan -->
        <div class="card-premium p-8 bg-emerald-600 text-white relative overflow-hidden group shadow-lg shadow-emerald-100">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-emerald-100 uppercase tracking-widest mb-1">Total Pemasukkan</p>
                <h3 class="text-3xl font-black tracking-tighter italic">
                    Rp {{ $formattedPemasukan ?? '0' }}
                </h3>
                <div class="mt-4 flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-white/20 text-white rounded text-[9px] font-black uppercase tracking-widest">Incoming</span>
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 animate-bounce"></i>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 text-white/5">
                <i data-lucide="trending-up" class="w-32 h-32"></i>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Pengeluaran</p>
                <h3 class="text-3xl font-black tracking-tighter italic text-red-500">
                    Rp {{ $formattedPengeluaran ?? '0' }}
                </h3>
                <div class="mt-4 flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-white/10 text-slate-300 rounded text-[9px] font-black uppercase tracking-widest">Outgoing</span>
                    <i data-lucide="arrow-down-right" class="w-3.5 h-3.5 text-red-500"></i>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 text-white/5">
                <i data-lucide="trending-down" class="w-32 h-32"></i>
            </div>
        </div>
    </div>

    <!-- Charts & Tables Section -->
    <div class="space-y-16 pb-20">
        
        <!-- Pemasukkan Section -->
        <div class="space-y-8">
            <div class="flex items-center gap-4 bg-emerald-50/50 p-4 rounded-2xl border border-emerald-100/50">
                <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200">
                    <i data-lucide="trending-up" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight uppercase">Analisis Pemasukkan</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Laporan Pendapatan Berdasarkan Kategori & Waktu</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Table Details -->
                <div class="lg:col-span-8 card-premium bg-white p-6 md:p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="space-y-1">
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Daftar Transaksi Masuk</h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter italic">Data sinkronisasi sistem pembayaran otomatis</p>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="w-full text-left" id="data-tables">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">No</th>
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi</th>
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori</th>
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah</th>
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-xs font-bold text-slate-600">
                                <!-- Ajax Content -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Graphic -->
                <div class="lg:col-span-4 card-premium bg-white p-8 space-y-8">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Filter Tahun Statistik</label>
                        <select id="yearFilter_pemasukkan" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-sm font-black tracking-tight uppercase outline-none focus:ring-4 focus:ring-emerald-50 focus:border-emerald-200 transition-all appearance-none cursor-pointer">
                            @foreach ($years_pemasukkan as $year)
                                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>Statistik Tahun {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="relative pt-4">
                        <canvas id="pemasukanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengeluaran Section -->
        <div class="space-y-8">
            <div class="flex items-center gap-4 bg-red-50/50 p-4 rounded-2xl border border-red-100/50">
                <div class="w-12 h-12 bg-slate-900 text-red-500 rounded-xl flex items-center justify-center shadow-lg shadow-slate-200">
                    <i data-lucide="trending-down" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight uppercase">Analisis Pengeluaran</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Monitoring Biaya Operasional & Pengeluaran Kas</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Graphic -->
                <div class="lg:col-span-4 card-premium bg-white p-8 space-y-8 order-2 lg:order-1">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Filter Tahun Statistik</label>
                        <select id="yearFilter_pengeluaran" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-sm font-black tracking-tight uppercase outline-none focus:ring-4 focus:ring-red-50 focus:border-red-200 transition-all appearance-none cursor-pointer">
                            @foreach ($years_pengeluaran as $year)
                                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>Statistik Tahun {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="relative pt-4">
                        <canvas id="pengeluaranChart"></canvas>
                    </div>
                </div>

                <!-- Table Details -->
                <div class="lg:col-span-8 card-premium bg-white p-6 md:p-8 order-1 lg:order-2">
                    <div class="flex items-center justify-between mb-8">
                        <div class="space-y-1">
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Daftar Biaya Keluar</h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter italic">Laporan pengeluaran dana operasional harian</p>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="w-full text-left" id="data-tables2">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">No</th>
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi</th>
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori</th>
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah</th>
                                    <th class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-xs font-bold text-slate-600">
                                <!-- Ajax Content -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@include('keuangan.script2')
