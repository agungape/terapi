@extends('layouts.master')
@section('title', 'Detail Program Terapi')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Detail Program</span>
        </div>
        <a href="{{ url()->previous() }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 rounded-xl text-xs font-bold transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- Left: Patient Overview --}}
        <div class="lg:col-span-3 space-y-6">
            <div class="card-premium relative overflow-hidden">
                <div class="h-20 bg-gradient-to-br from-red-500 to-red-600"></div>
                <div class="p-6 -mt-10 text-center">
                    <div class="w-20 h-20 rounded-[1.5rem] border-4 border-white shadow-xl mx-auto overflow-hidden bg-slate-100 flex items-center justify-center">
                        <span class="text-2xl font-black text-red-500 uppercase">{{ strtoupper(substr($anak->nama, 0, 2)) }}</span>
                    </div>
                    <h3 class="text-base font-black text-slate-800 uppercase tracking-tight mt-3">{{ $anak->nama }}</h3>
                    <p class="text-xs font-bold text-slate-400 mt-1">{{ $anak->usia }} Tahun</p>
                </div>
            </div>

            <div class="card-premium overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-50 bg-slate-50">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Biodata</h4>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap</p>
                        <p class="text-sm font-bold text-slate-700 mt-0.5">{{ $anak->nama }}</p>
                    </div>
                    <div class="h-px bg-slate-50"></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Alamat</p>
                        <p class="text-sm font-bold text-slate-600 mt-0.5">{{ $anak->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Visit History --}}
        <div class="lg:col-span-9">
            <div class="card-premium overflow-hidden" x-data="{ tab: 'riwayat' }">
                <div class="flex gap-1 p-2 bg-slate-50 border-b border-slate-100">
                    <button @click="tab = 'riwayat'"
                            :class="tab === 'riwayat' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                        <i data-lucide="history" class="w-4 h-4"></i> Riwayat Kunjungan
                    </button>
                </div>

                <div x-show="tab === 'riwayat'" class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-12">#</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pertemuan</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($kunjungan as $kun)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 text-xs font-bold text-slate-300">{{ $kunjungan->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="px-6 py-4 text-xs font-black text-slate-700 uppercase">Sesi {{ $kun->pertemuan }}</td>
                                <td class="px-6 py-4 text-xs font-bold text-slate-500">{{ $kun->created_at->format('d F Y, H:i') }}</td>
                                <td class="px-6 py-4 text-center">
                                    @php $badge = ['hadir' => 'bg-emerald-50 text-emerald-600 border-emerald-100', 'izin' => 'bg-amber-50 text-amber-600 border-amber-100', 'sakit' => 'bg-blue-50 text-blue-600 border-blue-100'][$kun->status ?? 'hadir'] ?? 'bg-slate-50 text-slate-400 border-slate-100'; @endphp
                                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-tighter border {{ $badge }}">{{ $kun->status ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('kunjungan.show', $kun->id) }}" class="inline-flex p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all border border-blue-100">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <i data-lucide="clipboard-x" class="w-10 h-10 text-slate-100 mx-auto mb-3"></i>
                                    <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada riwayat kunjungan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
                        {{ $kunjungan->fragment('judul')->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
</script>
@endsection
