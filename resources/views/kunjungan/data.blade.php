@extends('layouts.master')
@section('title', 'Rekam Medis & Riwayat Terapi')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    modalType: '',
    selectedId: '',
    selectedAnak: '',
    currentData: {},
    openModal(type, id, anak, data = {}) {
        this.modalType = type;
        this.selectedId = id;
        this.selectedAnak = anak;
        this.currentData = { ...data };
        this.modalOpen = true;
    },
    closeModal() {
        this.modalOpen = false;
    }
}" class="space-y-8 animate-in fade-in duration-500">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Rekam Medis</span>
            </div>
            <h2 class="text-3xl font-black text-slate-800 uppercase italic tracking-tighter">Riwayat <span class="text-red-500">Terapi</span> Anak</h2>
            <p class="text-xs font-bold text-slate-400">Manajemen data kunjungan dan rekam medis perkembangan anak.</p>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        @php
            $stats = [
                ['Total Kunjungan', $total, 'users', 'blue'],
                ['Hadir Hari Ini', $hadir, 'check-circle-2', 'emerald'],
                ['Izin', $izin, 'alert-circle', 'amber'],
                ['Izin Hangus', $izin_hangus, 'x-circle', 'red']
            ];
        @endphp
        @foreach($stats as $stat)
        <div class="card-premium p-5 md:p-6 flex items-center gap-4 md:gap-5 relative overflow-hidden group hover:shadow-xl hover:shadow-{{ $stat[3] }}-100/50 transition-all duration-500">
            <div class="absolute -right-4 -top-4 w-16 h-16 bg-{{ $stat[3] }}-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
            <div class="w-12 h-12 md:w-14 md:h-14 bg-{{ $stat[3] }}-50 rounded-2xl flex items-center justify-center text-{{ $stat[3] }}-500 shrink-0 relative z-10 transition-transform group-hover:scale-110">
                <i data-lucide="{{ $stat[2] }}" class="w-6 h-6 md:w-7 md:h-7"></i>
            </div>
            <div class="relative z-10">
                <p class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $stat[0] }}</p>
                <h3 class="text-xl md:text-2xl font-black text-slate-800 italic leading-none mt-1">{{ $stat[1] }}</h3>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Filter & Table --}}
    <div class="card-premium overflow-hidden border-none shadow-2xl shadow-slate-200/50">
        <div class="p-6 md:p-8 border-b border-slate-50 flex flex-col lg:flex-row lg:items-center gap-6 justify-between bg-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-red-100">
                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Daftar Kunjungan</h3>
                    <p class="text-[10px] font-bold text-slate-400">Total {{ $total }} data ditemukan</p>
                </div>
            </div>
            
            {{-- Date Range Filter --}}
            <form action="{{ route('kunjungan.pencarian') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <div class="relative flex-1 md:flex-none">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    <input type="text" id="reservation" name="date_range" value="{{ request('date_range') }}"
                           placeholder="Pilih rentang tanggal..."
                           class="pl-11 pr-5 py-3 bg-slate-50 border-slate-100 rounded-2xl text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none w-full md:w-64 border-2 focus:border-red-200">
                </div>
                <button type="submit" class="px-6 py-3 bg-slate-900 hover:bg-black text-white rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-slate-200 flex items-center gap-2">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i> Filter
                </button>
                @if(request('date_range'))
                <a href="{{ route('kunjungan.data') }}" class="px-5 py-3 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Reset</a>
                @endif
            </form>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block">
            <div class="overflow-x-auto scrollbar-hide">
                <table class="w-full text-left border-collapse min-w-[1000px]">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Aksi & NIB</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Anak / Terapi</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Sesi</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Kunjungan</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">E-Book</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($kunjungan as $kun)
                        <tr class="hover:bg-slate-50/30 transition-colors group">
                            {{-- Aksi & NIB --}}
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    @can('delete kunjungan')
                                    <form action="{{ route('kunjungan.destroy', ['kunjungan' => $kun->id]) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all border border-red-100 btn-hapus shadow-sm" data-name="{{ $kun->anak->nama }}">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                    @endcan
                                    
                                    @can('edit kunjungan')
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="flex items-center gap-2 px-4 py-2.5 bg-white text-slate-700 border-2 border-slate-100 rounded-2xl text-[10px] font-black uppercase transition-all hover:border-amber-200 hover:text-amber-600 shadow-sm">
                                            {{ $kun->anak->nib }}
                                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                             class="absolute left-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden z-20 p-2" x-cloak>
                                            @if ($kun->status === 'hadir')
                                            <button type="button" @click="openModal('tambah-terapis', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { terapis_id: '{{ $kun->terapis_id_pendamping }}' }); open = false"
                                                    class="w-full text-left px-4 py-3 text-xs font-bold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl flex items-center gap-3 transition-colors">
                                                <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                                                </div>
                                                Tambah Pendamping
                                            </button>
                                            @endif
                                            <button type="button" @click="openModal('edit-status', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { status: '{{ $kun->status }}' }); open = false"
                                                    class="w-full text-left px-4 py-3 text-xs font-bold text-slate-600 hover:bg-blue-50 hover:text-blue-700 rounded-xl flex items-center gap-3 transition-colors">
                                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                                    <i data-lucide="edit-2" class="w-4 h-4"></i>
                                                </div>
                                                Edit Status
                                            </button>
                                            <button type="button" @click="openModal('edit-terapis', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { terapis_id: '{{ $kun->terapis_id }}' }); open = false"
                                                    class="w-full text-left px-4 py-3 text-xs font-bold text-slate-600 hover:bg-amber-50 hover:text-amber-700 rounded-xl flex items-center gap-3 transition-colors">
                                                <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600">
                                                    <i data-lucide="user-cog" class="w-4 h-4"></i>
                                                </div>
                                                Ganti Terapis Utama
                                            </button>
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                            </td>
    
                            {{-- Anak --}}
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-2xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0 shadow-inner">
                                        <img src="{{ $kun->anak->foto ? asset('storage/anak/' . $kun->anak->foto) : asset('assets/images/faces/face1.jpg') }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex flex-col">
                                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $kun->anak->nama }}</h4>
                                        <span class="text-[10px] font-bold text-red-500 uppercase italic">{{ $kun->jenis_terapi == 'terapi_perilaku' ? 'Terapi Perilaku' : 'Fisioterapi' }}</span>
                                    </div>
                                </div>
                            </td>
    
                            {{-- Terapis --}}
                            <td class="px-8 py-5">
                                @if ($kun->status == 'hadir')
                                <div class="flex flex-col">
                                    <p class="text-xs font-bold text-slate-700">{{ $kun->terapis->nama }}</p>
                                    @if ($kun->terapis_id_pendamping)
                                    <span class="text-[9px] font-black text-emerald-500 uppercase flex items-center gap-1"><i data-lucide="plus" class="w-2.5 h-2.5"></i> {{ $kun->terapisPendamping->nama }}</span>
                                    @endif
                                </div>
                                @else
                                <span class="text-slate-300 italic text-xs font-medium">No Attendance</span>
                                @endif
                            </td>
    
                            {{-- Pertemuan --}}
                            <td class="px-8 py-5">
                                @if ($kun->status == 'hadir' || $kun->status == 'izin_hangus')
                                <div class="space-y-1">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-xl text-[10px] font-black uppercase border border-slate-200">{{ $kun->nama_pertemuan }}</span>
                                    @if (in_array($kun->anak_id . '-' . $kun->sesi . '-' . $kun->jenis_terapi, $completedSessions))
                                    <div class="mt-1">
                                        <span class="px-2 py-0.5 bg-emerald-500 text-white rounded text-[8px] font-black uppercase italic tracking-tighter">Completed</span>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <span class="text-slate-300 italic text-xs font-medium">-</span>
                                @endif
                            </td>
    
                            {{-- Waktu --}}
                            <td class="px-8 py-5">
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-700">{{ $kun->created_at->format('d M Y') }}</span>
                                    <span class="text-[10px] font-medium text-slate-400">{{ $kun->created_at->format('H:i') }} WIB</span>
                                </div>
                            </td>
    
                            {{-- Status --}}
                            <td class="px-8 py-5 text-center">
                                @php
                                    $statusMap = [
                                        'hadir' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                        'izin' => 'bg-amber-50 text-amber-600 border-amber-200',
                                        'sakit' => 'bg-blue-50 text-blue-600 border-blue-200',
                                        'izin_hangus' => 'bg-red-50 text-red-600 border-red-200',
                                    ];
                                    $cls = $statusMap[$kun->status] ?? 'bg-slate-50 text-slate-400 border-slate-200';
                                @endphp
                                <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border-2 {{ $cls }} italic shadow-sm">
                                    {{ str_replace('_', ' ', $kun->status) }}
                                </span>
                            </td>
    
                            {{-- E-Book --}}
                            <td class="px-8 py-5 text-center">
                                @can('show rekammedis')
                                @if ($kun->status == 'hadir')
                                <a href="{{ route('kunjungan.show', ['kunjungan' => $kun->id]) }}"
                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-red-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg hover:shadow-red-200 group/btn">
                                    <i data-lucide="book-open" class="w-4 h-4 group-hover/btn:scale-110 transition-transform"></i> E-Book
                                </a>
                                @endif
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Card List --}}
        <div class="md:hidden divide-y divide-slate-100">
            @foreach ($kunjungan as $kun)
            <div class="p-6 space-y-4 bg-white hover:bg-slate-50/50 transition-colors">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl border-2 border-slate-100 overflow-hidden shrink-0 shadow-sm">
                            <img src="{{ $kun->anak->foto ? asset('storage/anak/' . $kun->anak->foto) : asset('assets/images/faces/face1.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-800 uppercase italic tracking-tight">{{ $kun->anak->nama }}</h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $kun->anak->nib }}</p>
                        </div>
                    </div>
                    @php
                        $statusCls = [
                            'hadir' => 'text-emerald-500',
                            'izin' => 'text-amber-500',
                            'sakit' => 'text-blue-500',
                            'izin_hangus' => 'text-red-500',
                        ][$kun->status] ?? 'text-slate-400';
                    @endphp
                    <div class="text-right">
                        <span class="text-[10px] font-black uppercase italic {{ $statusCls }} tracking-widest">{{ str_replace('_', ' ', $kun->status) }}</span>
                        <p class="text-[9px] font-bold text-slate-400 mt-0.5">{{ $kun->created_at->format('d M, H:i') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 py-4 border-y border-slate-50">
                    <div class="space-y-1">
                        <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em]">Sesi Pertemuan</p>
                        <span class="text-[10px] font-black text-slate-700 uppercase tracking-tight">
                            @if ($kun->status == 'hadir' || $kun->status == 'izin_hangus')
                                {{ $kun->nama_pertemuan }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em]">Terapis</p>
                        <span class="text-[10px] font-black text-slate-700 uppercase tracking-tight">{{ $kun->status == 'hadir' ? $kun->terapis->nama : '-' }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-3 pt-2">
                    <div class="flex items-center gap-2">
                        @can('delete kunjungan')
                        <form action="{{ route('kunjungan.destroy', ['kunjungan' => $kun->id]) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-9 h-9 bg-red-50 text-red-500 rounded-xl flex items-center justify-center border border-red-100 btn-hapus" data-name="{{ $kun->anak->nama }}">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                        @endcan
                        
                        @can('edit kunjungan')
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="w-9 h-9 bg-slate-900 text-white rounded-xl flex items-center justify-center transition-all hover:bg-primary-500">
                                <i data-lucide="settings" class="w-4 h-4"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 class="absolute left-0 bottom-full mb-2 w-56 bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden z-20 p-2" x-cloak>
                                @if ($kun->status === 'hadir')
                                <button type="button" @click="openModal('tambah-terapis', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { terapis_id: '{{ $kun->terapis_id_pendamping }}' }); open = false"
                                        class="w-full text-left px-4 py-3 text-xs font-bold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl flex items-center gap-3 transition-colors">
                                    <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                        <i data-lucide="user-plus" class="w-3.5 h-3.5"></i>
                                    </div>
                                    Tambah Pendamping
                                </button>
                                @endif
                                <button type="button" @click="openModal('edit-status', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { status: '{{ $kun->status }}' }); open = false"
                                        class="w-full text-left px-4 py-3 text-xs font-bold text-slate-600 hover:bg-blue-50 hover:text-blue-700 rounded-xl flex items-center gap-3 transition-colors">
                                    <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                        <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                    </div>
                                    Edit Status
                                </button>
                                <button type="button" @click="openModal('edit-terapis', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { terapis_id: '{{ $kun->terapis_id }}' }); open = false"
                                        class="w-full text-left px-4 py-3 text-xs font-bold text-slate-600 hover:bg-amber-50 hover:text-amber-700 rounded-xl flex items-center gap-3 transition-colors">
                                    <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600">
                                        <i data-lucide="user-cog" class="w-3.5 h-3.5"></i>
                                    </div>
                                    Ganti Terapis Utama
                                </button>
                            </div>
                        </div>
                        @endcan
                    </div>
                    @can('show rekammedis')
                    @if ($kun->status == 'hadir')
                    <a href="{{ route('kunjungan.show', ['kunjungan' => $kun->id]) }}"
                       class="flex-1 bg-red-500 text-white py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-center italic shadow-lg shadow-red-100 flex items-center justify-center gap-2">
                        <i data-lucide="book-open" class="w-4 h-4"></i> Lihat E-Book
                    </a>
                    @endif
                    @endcan
                </div>
            </div>
            @endforeach
        </div>

        <div class="p-4 md:p-8 bg-slate-50 border-t border-slate-100 flex justify-center overflow-hidden">
            {{ $kunjungan->fragment('judul')->links() }}
        </div>
    </div>

    {{-- Alpine Modal Container --}}
    <div x-show="modalOpen" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-md" @click="closeModal()"></div>

        <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-lg relative z-10 overflow-hidden border border-slate-100"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <form :action="
                modalType === 'tambah-terapis' ? '{{ route('kunjungan.tambah-terapis', ':id') }}'.replace(':id', selectedId) : (
                modalType === 'edit-status' ? '{{ route('kunjungan.update-status', ':id') }}'.replace(':id', selectedId) :
                '{{ route('kunjungan.update-terapis', ':id') }}'.replace(':id', selectedId))
            " method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-slate-900 text-white p-8 flex items-center justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
                    <div class="flex items-center gap-5 relative z-10">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shadow-inner">
                            <i :data-lucide="modalType === 'tambah-terapis' ? 'user-plus' : (modalType === 'edit-status' ? 'edit-2' : 'user-cog')" 
                               :class="modalType === 'tambah-terapis' ? 'text-emerald-400' : (modalType === 'edit-status' ? 'text-blue-400' : 'text-amber-400')"></i>
                        </div>
                        <div>
                            <h5 class="text-xs font-black uppercase tracking-[0.2em] mb-1" 
                                x-text="modalType === 'tambah-terapis' ? 'Tambah Pendamping' : (modalType === 'edit-status' ? 'Ubah Status' : 'Ganti Terapis')"></h5>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest" x-text="selectedAnak"></p>
                        </div>
                    </div>
                    <button type="button" @click="closeModal()" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition-all relative z-10">
                        <i data-lucide="x" class="w-5 h-5 text-slate-300"></i>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    <template x-if="modalType === 'tambah-terapis'">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Terapis Pendamping</label>
                            <select name="terapis_id_pendamping" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-[1.5rem] px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-emerald-50 focus:border-emerald-200 transition-all outline-none appearance-none">
                                <option value="">-- Pilih Terapis --</option>
                                @foreach ($terapis as $t)
                                    <option value="{{ $t->id }}">{{ $t->nama }} ({{ $t->role }})</option>
                                @endforeach
                            </select>
                        </div>
                    </template>

                    <template x-if="modalType === 'edit-status'">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Status Kehadiran</label>
                            <select name="status" x-model="currentData.status" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-[1.5rem] px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 focus:border-blue-200 transition-all outline-none appearance-none">
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="izin_hangus">Izin Hangus</option>
                            </select>
                        </div>
                    </template>

                    <template x-if="modalType === 'edit-terapis'">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Terapis Pengganti</label>
                            <select name="terapis_id" x-model="currentData.terapis_id" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-[1.5rem] px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-amber-50 focus:border-amber-200 transition-all outline-none appearance-none">
                                @foreach ($terapis as $t)
                                    <option value="{{ $t->id }}">{{ $t->nama }} ({{ $t->role }})</option>
                                @endforeach
                            </select>
                        </div>
                    </template>
                </div>

                <div class="bg-slate-50/50 p-8 flex flex-col md:flex-row justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="closeModal()" 
                            class="px-8 py-4 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all hover:bg-slate-100">Batal</button>
                    <button type="submit" 
                            class="px-12 py-4 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl italic transition-all group"
                            :class="modalType === 'tambah-terapis' ? 'bg-emerald-500 hover:bg-emerald-600 shadow-emerald-100' : (modalType === 'edit-status' ? 'bg-blue-600 hover:bg-blue-700 shadow-blue-100' : 'bg-amber-500 hover:bg-amber-600 shadow-amber-100')">
                        Update Data <i data-lucide="arrow-right" class="w-3.5 h-3.5 inline ml-1 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // Date Range Picker
        if (typeof $ !== 'undefined' && typeof $.fn.daterangepicker === 'function') {
            $('#reservation').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD', separator: ' - ',
                    applyLabel: 'Pilih', cancelLabel: 'Batal',
                    daysOfWeek: ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
                    monthNames: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
                    firstDay: 1
                }
            });
            @if (request('date_range'))
                $('#reservation').val('{{ request('date_range') }}');
            @endif
        }
    });
</script>
@endsection
