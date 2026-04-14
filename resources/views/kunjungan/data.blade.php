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
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Rekam Medis</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Riwayat Terapi Anak</h2>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        <div class="card-premium p-6 flex items-center gap-5">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 shrink-0">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Kunjungan</p>
                <h3 class="text-2xl font-black text-slate-800 italic">{{ $total }}</h3>
            </div>
        </div>
        <div class="card-premium p-6 flex items-center gap-5">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 shrink-0">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Hadir Hari Ini</p>
                <h3 class="text-2xl font-black text-slate-800 italic">{{ $hadir }}</h3>
            </div>
        </div>
        <div class="card-premium p-6 flex items-center gap-5">
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 shrink-0">
                <i data-lucide="alert-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Izin</p>
                <h3 class="text-2xl font-black text-slate-800 italic">{{ $izin }}</h3>
            </div>
        </div>
        <div class="card-premium p-6 flex items-center gap-5">
            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 shrink-0">
                <i data-lucide="x-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Izin Hangus</p>
                <h3 class="text-2xl font-black text-slate-800 italic">{{ $izin_hangus }}</h3>
            </div>
        </div>
    </div>

    {{-- Filter & Table --}}
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row md:items-center gap-4 justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="clipboard-list" class="w-4 h-4 text-red-500"></i> DAFTAR KUNJUNGAN
            </h3>
            {{-- Date Range Filter --}}
            <form action="{{ route('kunjungan.pencarian') }}" method="GET" class="flex items-center gap-3">
                <div class="relative">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    <input type="text" id="reservation" name="date_range" value="{{ request('date_range') }}"
                           placeholder="Pilih rentang tanggal..."
                           class="pl-11 pr-5 py-2.5 bg-slate-50 border-slate-100 rounded-xl text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none w-60">
                </div>
                <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-black text-white rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-sm">Filter</button>
                @if(request('date_range'))
                <a href="{{ route('kunjungan.data') }}" class="px-4 py-2.5 bg-white border border-slate-200 text-slate-500 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">NIB / Aksi</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Pasien</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pertemuan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($kunjungan as $kun)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        {{-- NIB + Action Dropdown --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @can('delete kunjungan')
                                <form action="{{ route('kunjungan.destroy', ['kunjungan' => $kun->id]) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all border border-red-100 btn-hapus" data-name="{{ $kun->anak->nama }}">
                                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                                    </button>
                                </form>
                                @endcan
                                @can('edit kunjungan')
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center gap-1.5 px-3 py-2 bg-amber-50 text-amber-700 border border-amber-100 rounded-xl text-[10px] font-black uppercase transition-all hover:bg-amber-100">
                                        {{ $kun->anak->nib }}
                                        <i data-lucide="chevron-down" class="w-3 h-3"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                         class="absolute left-0 top-full mt-1 w-44 bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden z-20" x-cloak>
                                        @if ($kun->status === 'hadir')
                                        <button type="button" @click="openModal('tambah-terapis', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { terapis_id: '{{ $kun->terapis_id_pendamping }}' })"
                                                class="w-full text-left px-4 py-3 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                                            <i data-lucide="user-plus" class="w-3.5 h-3.5 text-emerald-500"></i> Tambah Terapis
                                        </button>
                                        @endif
                                        <button type="button" @click="openModal('edit-status', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { status: '{{ $kun->status }}' })"
                                                class="w-full text-left px-4 py-3 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                                            <i data-lucide="edit-2" class="w-3.5 h-3.5 text-blue-500"></i> Edit Status
                                        </button>
                                        <button type="button" @click="openModal('edit-terapis', '{{ $kun->id }}', '{{ $kun->anak->nama }}', { terapis_id: '{{ $kun->terapis_id }}' })"
                                                class="w-full text-left px-4 py-3 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                                            <i data-lucide="user-cog" class="w-3.5 h-3.5 text-amber-500"></i> Edit Terapis
                                        </button>
                                    </div>
                                </div>
                                @endcan
                            </div>
                        </td>

                        {{-- Nama --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0">
                                    <img src="{{ $kun->anak->foto ? asset('storage/anak/' . $kun->anak->foto) : asset('assets/images/faces/face1.jpg') }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $kun->anak->nama }}</h4>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase">{{ $kun->jenis_terapi == 'terapi_perilaku' ? 'Terapi Perilaku' : 'Fisioterapi' }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Terapis --}}
                        <td class="px-6 py-4">
                            @if ($kun->status == 'hadir')
                            <p class="text-xs font-bold text-slate-700 tracking-tight">{{ $kun->terapis->nama }}</p>
                            @if ($kun->terapis_id_pendamping)
                            <p class="text-[9px] font-black text-emerald-500 uppercase">+ {{ $kun->terapisPendamping->nama }}</p>
                            @endif
                            @else
                            <span class="text-slate-300 italic text-xs">-</span>
                            @endif
                        </td>

                        {{-- Pertemuan --}}
                        <td class="px-6 py-4">
                            @if ($kun->status == 'hadir' || $kun->status == 'izin_hangus')
                            <div class="space-y-1">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-[10px] font-black uppercase">{{ $kun->nama_pertemuan }}</span>
                                @if (in_array($kun->anak_id . '-' . $kun->sesi . '-' . $kun->jenis_terapi, $completedSessions))
                                <div>
                                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded text-[9px] font-black uppercase italic tracking-tighter">Season Selesai</span>
                                </div>
                                @endif
                            </div>
                            @else
                            <span class="text-slate-300 italic text-xs">-</span>
                            @endif
                        </td>

                        {{-- Tanggal --}}
                        <td class="px-6 py-4 text-xs font-bold text-slate-500 whitespace-nowrap">
                            {{ $kun->created_at->format('d M Y, H:i') }}
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">
                            @php
                                $statusMap = [
                                    'hadir' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                    'izin' => 'bg-amber-50 text-amber-600 border-amber-100',
                                    'sakit' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    'izin_hangus' => 'bg-red-50 text-red-600 border-red-100',
                                ];
                                $cls = $statusMap[$kun->status] ?? 'bg-slate-50 text-slate-400 border-slate-100';
                            @endphp
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $cls }} italic">
                                {{ str_replace('_', ' ', $kun->status) }}
                            </span>
                        </td>

                        {{-- Detail --}}
                        <td class="px-6 py-4 text-center">
                            @can('show rekammedis')
                            @if ($kun->status == 'hadir')
                            <a href="{{ route('kunjungan.show', ['kunjungan' => $kun->id]) }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm shadow-red-100">
                                <i data-lucide="book-open" class="w-3.5 h-3.5"></i> E-Book
                            </a>
                            @endif
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
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
        
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="closeModal()"></div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-lg relative z-10 overflow-hidden border border-slate-100"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <form :action="
                modalType === 'tambah-terapis' ? '{{ route('kunjungan.tambah-terapis', ':id') }}'.replace(':id', selectedId) : (
                modalType === 'edit-status' ? '{{ route('kunjungan.update-status', ':id') }}'.replace(':id', selectedId) :
                '{{ route('kunjungan.update-terapis', ':id') }}'.replace(':id', selectedId))
            " method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-slate-900 text-white p-7 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i :data-lucide="modalType === 'tambah-terapis' ? 'user-plus' : (modalType === 'edit-status' ? 'edit-2' : 'user-cog')" 
                               :class="modalType === 'tambah-terapis' ? 'text-emerald-400' : (modalType === 'edit-status' ? 'text-blue-400' : 'text-amber-400')"></i>
                        </div>
                        <h5 class="text-sm font-black uppercase tracking-widest mb-0" 
                            x-text="modalType === 'tambah-terapis' ? 'Tambah Terapis Pendamping' : (modalType === 'edit-status' ? 'Ubah Status Kunjungan' : 'Ganti Terapis Utama')"></h5>
                    </div>
                    <button type="button" @click="closeModal()" class="text-slate-400 hover:text-white transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Pasien Terpilih</p>
                        <p class="text-xs font-black text-slate-700 uppercase italic tracking-tight" x-text="selectedAnak"></p>
                    </div>

                    <template x-if="modalType === 'tambah-terapis'">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Terapis Pendamping</label>
                            <select name="terapis_id_pendamping" required class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-emerald-50 transition-all outline-none">
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
                            <select name="status" x-model="currentData.status" required class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none">
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
                            <select name="terapis_id" x-model="currentData.terapis_id" required class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-amber-50 transition-all outline-none">
                                @foreach ($terapis as $t)
                                    <option value="{{ $t->id }}">{{ $t->nama }} ({{ $t->role }})</option>
                                @endforeach
                            </select>
                        </div>
                    </template>
                </div>

                <div class="bg-slate-50 p-7 flex justify-end gap-3">
                    <button type="button" @click="closeModal()" 
                            class="px-8 py-3.5 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all hover:bg-slate-100">Batal</button>
                    <button type="submit" 
                            class="px-12 py-3.5 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl italic transition-all"
                            :class="modalType === 'tambah-terapis' ? 'bg-emerald-500 hover:bg-emerald-600 shadow-emerald-100' : (modalType === 'edit-status' ? 'bg-blue-600 hover:bg-blue-700 shadow-blue-100' : 'bg-amber-500 hover:bg-amber-600 shadow-amber-100')">
                        Update Data
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
