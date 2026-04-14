@extends('layouts.master')
@section('title', 'Profil Terapis: ' . $terapi->nama)

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">

    {{-- Breadcrumb --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('terapis.index') }}" class="hover:text-red-500 transition-colors">Data Terapis</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Profil</span>
        </div>
        <a href="{{ route('terapis.index') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 rounded-xl text-xs font-bold transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- Left: Therapist Profile --}}
        <div class="lg:col-span-3 space-y-6">
            {{-- Profile Card --}}
            <div class="card-premium relative overflow-hidden">
                <div class="h-24 bg-gradient-to-br from-slate-700 to-slate-900 relative overflow-hidden">
                    <i data-lucide="activity" class="w-32 h-32 text-white/5 absolute -right-4 -top-4 rotate-12"></i>
                </div>
                <div class="p-6 -mt-12 text-center">
                    <div class="w-24 h-24 rounded-3xl border-4 border-white shadow-xl mx-auto overflow-hidden bg-slate-100/50 backdrop-blur-sm relative group">
                        <img src="{{ $terapis->foto ? asset('storage/terapis/' . $terapis->foto) : asset('assets/images/faces/face1.jpg') }}"
                             alt="Photo" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3 class="text-base font-black text-slate-800 uppercase tracking-tight mt-3">{{ $terapi->nama }}</h3>
                    <span class="inline-block mt-2 px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded-lg text-[10px] font-black uppercase tracking-wider">
                        {{ $terapi->role }}
                    </span>
                </div>
            </div>

            {{-- Biodata --}}
            <div class="card-premium overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-50 bg-slate-50">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="user" class="w-3.5 h-3.5 text-red-500"></i> Biodata Terapis
                    </h4>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Usia</p>
                        <p class="text-sm font-bold text-slate-700 mt-0.5">{{ $tanggal_lahir }} Tahun</p>
                    </div>
                    <div class="h-px bg-slate-50"></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Jenis Kelamin</p>
                        <p class="text-sm font-bold text-slate-700 mt-0.5">{{ $terapi->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
                    </div>
                    <div class="h-px bg-slate-50"></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Alamat</p>
                        <p class="text-sm font-bold text-slate-600 mt-0.5 leading-relaxed">{{ $terapi->alamat ?? '-' }}</p>
                    </div>
                    <div class="h-px bg-slate-50"></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Telepon</p>
                        <p class="text-sm font-bold text-slate-700 mt-0.5">{{ $terapi->telepon ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Tabs --}}
        <div class="lg:col-span-9">
            <div class="card-premium overflow-hidden" x-data="{ tab: 'pelatihan' }">
                {{-- Tab Header --}}
                <div class="flex gap-1 p-2 bg-slate-50 border-b border-slate-100">
                    <button @click="tab = 'pelatihan'"
                            :class="tab === 'pelatihan' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                        <i data-lucide="award" class="w-4 h-4"></i> Riwayat Pelatihan
                    </button>
                    <button @click="tab = 'aktivitas'"
                            :class="tab === 'aktivitas' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                        <i data-lucide="activity" class="w-4 h-4"></i> Aktivitas Terapi
                    </button>
                </div>

                {{-- Tab: Pelatihan --}}
                <div x-show="tab === 'pelatihan'" x-transition>
                    <div class="px-8 py-5 flex justify-between items-center border-b border-slate-50">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sertifikat & Pelatihan</h4>
                        <a href="{{ route('terapis.pelatihan', ['terapi' => $terapi->id]) }}"
                           class="flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Pelatihan
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                                    <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Instansi</th>
                                    <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Nama Pelatihan</th>
                                    <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Sertifikat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($terapis->pelatihans as $t)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-4 text-xs font-bold text-slate-600 whitespace-nowrap">{{ $t->pivot->tanggal }}</td>
                                    <td class="px-8 py-4 text-xs font-bold text-slate-700">{{ $t->instansi }}</td>
                                    <td class="px-8 py-4 text-xs font-bold text-slate-700">{{ $t->nama }}</td>
                                    <td class="px-8 py-4">
                                        @if ($t->pivot->sertifikat)
                                        <a href="{{ route('sertifikat.show', ['sertifikat' => $t->pivot->id]) }}" target="_blank"
                                           class="flex items-center gap-2 text-blue-600 hover:underline text-xs font-bold">
                                            <i data-lucide="file-badge" class="w-4 h-4"></i>
                                            Lihat Sertifikat
                                        </a>
                                        @else
                                        <span class="text-slate-300 italic text-xs">Tidak ada</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-16 text-center">
                                        <i data-lucide="award" class="w-10 h-10 text-slate-100 mx-auto mb-3"></i>
                                        <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada riwayat pelatihan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tab: Aktivitas --}}
                <div x-show="tab === 'aktivitas'" x-transition x-cloak>
                    <div class="px-8 py-5 flex justify-between items-center border-b border-slate-50">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Riwayat Sesi Terapi</h4>
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-widest">{{ $activity->total() }} Sesi</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Waktu / Sesi</th>
                                    <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Pasien Anak</th>
                                    <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Layanan</th>
                                    <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($activity as $act)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-4 whitespace-nowrap">
                                        <p class="text-xs font-black text-slate-700">{{ \Carbon\Carbon::parse($act->tanggal_kunjungan)->translatedFormat('d M Y') }}</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">{{ $act->jam_mulai }} - {{ $act->jam_selesai }}</p>
                                    </td>
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-2">
                                            <p class="text-xs font-bold text-slate-700">{{ $act->anak->nama }}</p>
                                        </div>
                                    </td>
                                    <td class="px-8 py-4 text-xs font-bold text-slate-600">
                                        {{ $act->tarif->nama_tarif ?? 'Terapi Umum' }}
                                    </td>
                                    <td class="px-8 py-4">
                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest
                                            @if($act->status == 'hadir') bg-emerald-50 text-emerald-600 border border-emerald-100
                                            @elseif($act->status == 'izin') bg-amber-50 text-amber-600 border border-amber-100
                                            @else bg-red-50 text-red-600 border border-red-100 @endif">
                                            {{ $act->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-16 text-center text-slate-300 italic font-bold uppercase tracking-widest text-[10px]">
                                        Belum ada riwayat aktivitas terapi
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="p-6 bg-slate-50/30 border-t border-slate-50">
                            {{ $activity->links() }}
                        </div>
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
