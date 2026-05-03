@extends('layouts.master')
@section('title', 'Laporan Keuangan Terpadu')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-primary-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Arsip Laporan Keuangan</span>
        </div>
        
        <div class="flex items-center gap-3">
            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest hidden sm:block">Total Archive</span>
            <div class="px-3 py-1 bg-white rounded-full border border-slate-200 text-[11px] font-black text-slate-600 shadow-sm">
                {{ count($financialReport) }} RECORDS
            </div>
        </div>
    </div>

    <!-- Filter & Export Card -->
    <div class="card-premium p-6 md:p-8 bg-white border-none shadow-xl shadow-slate-200/50">
        <form action="{{ route('keuangan.laporan') }}" method="GET" class="flex flex-col lg:flex-row items-end gap-6">
            <div class="w-full lg:w-1/3 space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                    <i data-lucide="calendar-range" class="w-3.5 h-3.5"></i> Rentang Tanggal Laporan
                </label>
                <div class="relative group">
                    <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300 group-focus-within:text-primary-500 transition-colors"></i>
                    <input type="text" id="reservation" name="date_range" 
                           class="w-full bg-slate-50 border-slate-100 rounded-2xl pl-12 pr-6 py-4 text-sm font-bold focus:ring-4 focus:ring-primary-50 transition-all outline-none" placeholder="Pilih Tanggal...">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full lg:w-auto">
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white py-4 px-8 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all">
                    <i data-lucide="filter" class="w-4 h-4"></i> Filter Data
                </button>
                
                <a href="#" id="export-pdf" class="bg-primary-500 hover:bg-primary-600 text-white py-4 px-8 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-lg shadow-primary-100">
                    <i data-lucide="printer" class="w-4 h-4"></i> Cetak Laporan (PDF)
                </a>
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="card-premium overflow-hidden bg-white">
        <div class="p-6 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="database" class="w-4 h-4 text-red-600"></i> HASIL AUDIT TRANSAKSI
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[1000px]">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori Transaksi</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Nominal (IDR)</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi Operasional</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Saldo Terakhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    {{-- Opening Balance Row --}}
                    <tr class="bg-slate-50/30">
                        <td class="px-6 py-5">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Saldo Awal</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-400 rounded-lg text-[9px] font-black uppercase tracking-widest border border-slate-200 italic">Carry Over</span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <span class="text-xs font-bold text-slate-400">-</span>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-[10px] font-bold text-slate-400 italic">Saldo kumulatif sebelum tanggal {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</p>
                        </td>
                        <td class="px-6 py-5 text-right font-black text-slate-900 tracking-tighter text-sm">
                            Rp {{ number_format($openingBalance, 0, ',', '.') }}
                        </td>
                    </tr>

                    @forelse ($financialReport as $report)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-5">
                            <span class="text-xs font-bold text-slate-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($report->tanggal)->translatedFormat('d M Y') }}</span>
                        </td>
                        <td class="px-6 py-5">
                            @if ($report->jenis == 'pemasukkan')
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-emerald-100 italic">Incoming</span>
                            @else
                                <span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-red-100 italic">Outgoing</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <span class="text-sm font-black tracking-tighter {{ $report->jenis == 'pemasukkan' ? 'text-emerald-600' : 'text-red-500' }}">
                                {{ $report->jenis == 'pemasukkan' ? '+' : '-' }} {{ number_format($report->jumlah, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-xs font-bold text-slate-700 tracking-tight min-w-[150px]">{{ $report->deskripsi }}</p>
                        </td>
                        <td class="px-6 py-5 text-right font-black text-slate-900 tracking-tighter text-sm">
                            Rp {{ number_format($report->current_balance, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-24 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <i data-lucide="inbox" class="w-12 h-12 text-slate-200"></i>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic tracking-widest">Tidak ada laporan untuk periode ini</p>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DateRangePicker Assets -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // Inisialisasi Date Range Picker dengan style yang lebih bersih
        $('#reservation').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' - ',
                applyLabel: 'PIlih',
                cancelLabel: 'Batal',
                fromLabel: 'Dari',
                toLabel: 'Hingga',
                customRangeLabel: 'Kustom',
                daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                firstDay: 1
            }
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        // Set nilai awal jika ada dari request
        @if (request('date_range'))
            $('#reservation').val('{{ request('date_range') }}');
        @endif

        // Event saat klik tombol Export PDF
        $('#export-pdf').on('click', function(e) {
            e.preventDefault();

            let dateRange = $('#reservation').val();
            if (dateRange) {
                let dates = dateRange.split(' - ');
                let start = dates[0].trim();
                let end = dates[1].trim();

                // Ganti URL ke route yang sesuai manual
                let url = `/keuangan/laporan/pdf/${start}/${end}`;
                window.open(url, '_blank');
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Tanggal',
                    text: 'Silakan pilih rentang tanggal terlebih dahulu sebelum mengekspor.',
                    confirmButtonColor: '#ef4444'
                });
            }
        });
    });
</script>

<style>
    /* Custom style for DateRangePicker to match premium theme */
    .daterangepicker {
        border-radius: 1.5rem !important;
        border: none !important;
        box-shadow: 0 10px 50px rgba(0,0,0,0.1) !important;
        padding: 1rem !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    .daterangepicker .applyBtn {
        background-color: #ef4444 !important;
        border: none !important;
        border-radius: 0.75rem !important;
        padding: 0.5rem 1.5rem !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        font-size: 10px !important;
    }
</style>
@endsection
