@extends('layouts.master')
@section('title', 'Jadwal Layanan Terapi')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Manajemen Jadwal Harian</span>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="px-4 py-2 bg-white rounded-xl border border-slate-200 shadow-sm flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Live Schedule</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Action Panel (Add Schedule) -->
        <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-8">
            <div class="card-premium p-8 bg-white border-none shadow-xl shadow-slate-200/50">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-2.5 bg-red-50 rounded-xl text-red-500">
                        <i data-lucide="calendar-plus" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Buka Slot Jadwal</h3>
                </div>

                <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Pasien (Anak)</label>
                        <select name="anak_id" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-800 outline-none focus:ring-4 focus:ring-red-50 transition-all">
                            @forelse ($anaks as $anak)
                                <option value="{{ $anak->id }}" {{ old('anak_id') == $anak->id ? 'selected' : '' }}>{{ $anak->nama }}</option>
                            @empty
                                <option disabled>Tidak ada data anak</option>
                            @endforelse
                        </select>
                        @error('anak_id') <p class="text-[9px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis Pendamping</label>
                        <select name="terapis_id" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-800 outline-none focus:ring-4 focus:ring-red-50 transition-all">
                            @forelse ($terapis as $terapi)
                                <option value="{{ $terapi->id }}" {{ (old('terapis_id') ?? ($jadwal->terapis_id ?? '')) == $terapi->id ? 'selected' : '' }}>{{ $terapi->nama }}</option>
                            @empty
                                <option disabled>Tidak ada data terapis</option>
                            @endforelse
                        </select>
                        @error('terapis_id') <p class="text-[9px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                                   class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-black text-red-600 outline-none focus:ring-4 focus:ring-red-50 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Jam Layanan</label>
                            <select name="waktu" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-800 outline-none focus:ring-4 focus:ring-red-50 transition-all">
                                @foreach ($availableWaktu as $waktu => $label)
                                    <option value="{{ $waktu }}" {{ old('waktu') == $waktu ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @can('create jadwal anak')
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-lg shadow-red-100 transition-all flex items-center justify-center gap-2 mt-4">
                        <i data-lucide="check-circle" class="w-4 h-4"></i> Konfirmasi Jadwal
                    </button>
                    @endcan
                </form>
            </div>

            <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden group">
                <div class="relative z-10 flex flex-col gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-red-500">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-xs font-black uppercase tracking-widest italic">Zona Waktu: WITA</h4>
                        <p class="text-[10px] text-slate-400 font-bold leading-relaxed">Seluruh sinkronisasi jadwal mengikuti waktu Indonesia Tengah.</p>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 text-white/5"><i data-lucide="clock" class="w-24 h-24"></i></div>
            </div>
        </div>

        <!-- Schedule List Panel -->
        <div class="lg:col-span-8">
            <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
                <div class="p-6 border-b border-slate-50 bg-white flex items-center justify-between">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-red-500"></i> AGENDA TERAPI HARI INI
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu & Sesi</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Detail Pasien</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($jadwals as $jadwal)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2.5 bg-red-50 rounded-xl text-red-600 font-black text-[11px] tracking-tighter shadow-sm border border-red-100">
                                            {{ substr($jadwal->waktu, 0, 5) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-black text-slate-800 uppercase tracking-tight">{{ $jadwal->hari }}</span>
                                            <span class="text-[9px] font-bold text-slate-400 tracking-widest">{{ $jadwal->tanggal }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-blue-500 flex items-center justify-center text-white text-[10px] font-black shadow-md shadow-blue-100 uppercase">
                                            {{ substr($jadwal->anak->nama, 0, 2) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $jadwal->anak->nama }}</span>
                                            <span class="text-[9px] font-bold text-blue-500 uppercase tracking-widest">Pertemuan {{ $jadwal->pertemuan }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-slate-600 tracking-tight">{{ $jadwal->terapis->nama }}</span>
                                        <div class="flex items-center gap-1 mt-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Assigned</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-amber-100 italic shadow-sm">Scheduled</span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        @can('create jadwal anak')
                                        <a href="{{ route('jadwal.edit', ['jadwal' => $jadwal->id]) }}" class="p-2 bg-slate-50 text-slate-500 rounded-xl hover:bg-slate-900 hover:text-white transition-all border border-slate-100 shadow-sm" title="Edit Jadwal">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </a>
                                        @endcan

                                        @can('delete jadwal anak')
                                        <form action="{{ route('jadwal.destroy', ['jadwal' => $jadwal->id]) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus" 
                                                    data-name="{{ $jadwal->anak->nama }}" data-table="jadwal" title="Hapus Jadwal">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-32 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i data-lucide="calendar-x" class="w-12 h-12 text-slate-200"></i>
                                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] italic">Belum ada jadwal yang terdaftar hari ini...</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
                    {{ $jadwals->fragment('judul')->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection
