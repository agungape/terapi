@extends('layouts.master')
@section('title', 'Profil Anak: ' . $anak->nama)

@section('content')
<div class="space-y-8">
    
    <!-- Top Bar / Breadcrumb replacement -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('anak.index') }}" class="hover:text-red-500 transition-colors">Data Anak</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">User Profile</span>
        </div>
        <a href="{{ route('anak.index') }}" class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 py-2 px-4 rounded-xl text-xs font-bold flex items-center justify-center gap-2 transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Left Column: User Card & Bio -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Main Profile Card -->
            <div class="card-premium p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-br from-red-500/10 to-red-600/5 -z-0"></div>
                <div class="relative z-10">
                    <div class="w-24 h-24 rounded-full border-4 border-white shadow-md mx-auto mb-4 overflow-hidden bg-slate-100">
                        <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/images/faces/face1.jpg') }}" 
                             alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-extrabold text-slate-800 leading-tight">{{ $anak->nama }}</h3>
                    <div class="flex items-center justify-center gap-2 mt-2">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-wider">
                            {{ $anak->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                        </span>
                        <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-wider">
                            {{ $anak->usia }} Tahun
                        </span>
                    </div>
                </div>
            </div>

            <!-- Biodata Details -->
            <div class="card-premium overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="info" class="w-3.5 h-3.5 text-red-500"></i> BIODATA DASAR
                    </h4>
                </div>
                <div class="p-6 space-y-5">
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pendidikan</p>
                        <p class="text-sm font-bold text-slate-700">{{ $anak->pendidikan }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat</p>
                        <p class="text-sm font-bold text-slate-700 leading-relaxed">{{ $anak->alamat }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Diagnosa</p>
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-xs font-bold text-slate-600 italic">"{{ $anak->diagnosa }}"</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Card -->
            <div class="card-premium">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="phone-call" class="w-3.5 h-3.5 text-red-500"></i> KONTAK KELUARGA
                    </h4>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Ayah -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase">Ayah</p>
                            <p class="text-xs font-bold text-slate-700">{{ $anak->telepon_ayah ?? '-' }}</p>
                        </div>
                        @if($anak->telepon_ayah)
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $anak->telepon_ayah)) }}" target="_blank" class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition-all">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>
                    <hr class="border-slate-50">
                    <!-- Ibu -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase">Ibu</p>
                            <p class="text-xs font-bold text-slate-700">{{ $anak->telepon_ibu ?? '-' }}</p>
                        </div>
                        @if($anak->telepon_ibu)
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $anak->telepon_ibu)) }}" target="_blank" class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition-all">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Active Packages & Tabs -->
        <div class="lg:col-span-3 space-y-8">
            
            <!-- Active Packages Visualization -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($activePackages as $pkg)
                <div class="card-premium p-6 relative overflow-hidden group">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full opacity-50 group-hover:scale-125 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Paket Aktif</h4>
                                <h3 class="text-sm font-extrabold text-slate-800">{{ $pkg->tarif->nama }}</h3>
                            </div>
                            <div class="bg-red-50 text-red-600 px-3 py-1.5 rounded-xl text-xs font-black border border-red-100">
                                {{ $pkg->sisa_pertemuan }} <span class="text-[9px] uppercase font-bold text-red-400 ml-1">Sesi Sisa</span>
                            </div>
                        </div>
                        
                        @php 
                            $total = $pkg->tarif->jumlah_pertemuan ?? 0;
                            $used = $pkg->sudah_terpakai ?? 0;
                            $percent = $total > 0 ? ($used / $total) * 100 : 0;
                        @endphp
                        
                        <div class="space-y-2">
                            <div class="flex justify-between text-[10px] font-extrabold text-slate-500 uppercase">
                                <span>Progres Sesi ({{ $used }}/{{ $total }})</span>
                                <span>{{ round($percent) }}%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-red-500 to-red-600 transition-all duration-1000 shadow-[0_0_8px_rgba(220,38,38,0.3)]" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-slate-50 flex items-center gap-2">
                            <i data-lucide="tag" class="w-3.5 h-3.5 text-slate-300"></i>
                            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">{{ ucwords(str_replace('_', ' ', $pkg->tarif->jenis_terapi)) }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="card-premium p-8 text-center md:col-span-2 bg-slate-50/50 border-dashed border-2">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm">
                        <i data-lucide="alert-circle" class="w-6 h-6 text-slate-300"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest tracking-widest">Belum ada paket aktif yang terdaftar</p>
                </div>
                @endforelse
            </div>

            <!-- History Tabs -->
            <div class="card-premium" x-data="{ tab: 'perilaku' }">
                <div class="p-2 border-b border-slate-100 flex gap-2">
                    <button @click="tab = 'perilaku'" 
                            :class="tab === 'perilaku' ? 'bg-red-50 text-red-600' : 'text-slate-500 hover:bg-slate-50'"
                            class="flex-1 py-3 px-4 rounded-xl text-xs font-extrabold uppercase tracking-widest transition-all">
                        Terapi Perilaku
                    </button>
                    <button @click="tab = 'fisio'" 
                            :class="tab === 'fisio' ? 'bg-red-50 text-red-600' : 'text-slate-500 hover:bg-slate-50'"
                            class="flex-1 py-3 px-4 rounded-xl text-xs font-extrabold uppercase tracking-widest transition-all">
                        Fisioterapi & SI
                    </button>
                </div>

                <div class="p-0">
                    <!-- Tab Perilaku -->
                    <div x-show="tab === 'perilaku'" x-transition:enter="transition-opacity duration-300" class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Sesi</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($kunjungan as $kun)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-black text-slate-700 text-xs">Season {{ $kun->sesi }} <span class="text-slate-400 ml-1">#{{ $kun->pertemuan }}</span></td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[8px] font-black text-slate-500">{{ strtoupper(substr($kun->terapis->nama, 0, 1)) }}</div>
                                            <span class="text-xs font-bold text-slate-600 lowercase">{{ $kun->terapis->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-bold text-slate-500">{{ $kun->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $badgeClass = [
                                                'hadir' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'izin' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'sakit' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                'izin_hangus' => 'bg-red-50 text-red-600 border-red-100'
                                            ][$kun->status] ?? 'bg-slate-100';
                                        @endphp
                                        <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-tighter border {{ $badgeClass }}">
                                            {{ str_replace('_', ' ', $kun->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-xs font-bold text-slate-400 italic">Belum ada riwayat kunjungan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="p-6 bg-slate-50/30 border-t border-slate-100">
                            {{ $kunjungan->fragment('perilaku')->links() }}
                        </div>
                    </div>

                    <!-- Tab Fisio -->
                    <div x-show="tab === 'fisio'" x-transition:enter="transition-opacity duration-300" class="overflow-x-auto" x-cloak>
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Sesi</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($fisioterapi as $fis)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-black text-slate-700 text-xs">Season {{ $fis->sesi }} <span class="text-slate-400 ml-1">#{{ $fis->pertemuan }}</span></td>
                                    <td class="px-6 py-4 px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[8px] font-black text-slate-500">{{ strtoupper(substr($fis->terapis->nama??'T', 0, 1)) }}</div>
                                            <span class="text-xs font-bold text-slate-600 lowercase">{{ $fis->terapis->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-bold text-slate-500">{{ $fis->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $badgeClass = [
                                                'hadir' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'izin' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'sakit' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                'izin_hangus' => 'bg-red-50 text-red-600 border-red-100'
                                            ][$fis->status] ?? 'bg-slate-100';
                                        @endphp
                                        <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-tighter border {{ $badgeClass }}">
                                            {{ str_replace('_', ' ', $fis->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-xs font-bold text-slate-400 italic">Belum ada riwayat kunjungan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="p-6 bg-slate-50/30 border-t border-slate-100">
                            {{ $fisioterapi->fragment('fisio')->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection
