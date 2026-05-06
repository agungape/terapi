@extends('layouts.master')
@section('title', 'Data Anak')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        showProgressModal: false, 
        selectedPackages: [], 
        selectedAnakName: '',
        openProgress(name, packages) {
            this.selectedAnakName = name;
            this.selectedPackages = packages;
            this.showProgressModal = true;
        }
     }">
    
    <!-- Top Bar / Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Master Data Anak</span>
        </div>
        
        <div class="flex items-center gap-4">
            <form action="{{ route('anak.index') }}" method="GET" class="relative group">
                <i data-lucide="search" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-red-500 transition-colors"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / NIB..." 
                       class="bg-white border border-slate-200 rounded-xl pl-11 pr-4 py-2.5 text-xs font-bold focus:ring-4 focus:ring-red-50 focus:border-red-200 outline-none w-64 transition-all shadow-sm">
            </form>

            @can('create anak')
            <a href="{{ route('anak.create') }}" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
                <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Data Anak
            </a>
            @endcan
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Aktif -->
        <div class="card-premium p-6 group border-b-4 border-b-emerald-500">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Aktif</span>
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg group-hover:bg-emerald-500 group-hover:text-white transition-all">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ $aktif ?? 0 }}</h3>
            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase">Pasien Mengikuti Program</p>
        </div>

        <!-- Nonaktif -->
        <div class="card-premium p-6 group border-b-4 border-b-slate-300">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Rehat</span>
                <div class="p-2 bg-slate-50 text-slate-400 rounded-lg group-hover:bg-slate-400 group-hover:text-white transition-all">
                    <i data-lucide="pause-circle" class="w-4 h-4"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ $nonaktif ?? 0 }}</h3>
            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase">Pasien Non-Aktif</p>
        </div>

        <!-- Laki-laki -->
        <div class="card-premium p-6 group border-b-4 border-b-blue-500">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Male</span>
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg group-hover:bg-blue-500 group-hover:text-white transition-all">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ $pria }}</h3>
            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase">Anak Laki-Laki</p>
        </div>

        <!-- Perempuan -->
        <div class="card-premium p-6 group border-b-4 border-b-pink-400">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Female</span>
                <div class="p-2 bg-pink-50 text-pink-500 rounded-lg group-hover:bg-pink-500 group-hover:text-white transition-all">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ $wanita }}</h3>
            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase">Anak Perempuan</p>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-white flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="users" class="w-4 h-4 text-red-500"></i> LIST PASIEN TERDAFTAR
            </h3>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block">
            <div class="overflow-x-auto scrollbar-hide">
                <table class="w-full text-left min-w-[1000px]">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Biodata</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Usia</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pencapaian / Progres</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Lokasi</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($anaks as $anak)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shadow-sm shrink-0">
                                        <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/images/faces/face1.jpg') }}" 
                                             alt="Foto" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $anak->nama }}</h4>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase mt-0.5 tracking-tighter">NIB: {{ $anak->nib ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-slate-600">{{ $anak->usia }} Tahun</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($anak->active_packages->count() > 0)
                                <button @click="openProgress('{{ addslashes($anak->nama) }}', {{ $anak->packages_data->toJson() }})" 
                                        class="flex items-center gap-2 px-3 py-1.5 bg-red-50 text-red-600 rounded-lg border border-red-100 hover:bg-red-500 hover:text-white transition-all group">
                                    <span class="text-[10px] font-black uppercase tracking-tight">{{ $anak->active_packages->count() }} Paket Aktif</span>
                                    <i data-lucide="bar-chart-3" class="w-3 h-3 transition-transform group-hover:scale-110"></i>
                                </button>
                                @else
                                <span class="text-[10px] font-bold text-slate-300 italic uppercase">Belum ada paket aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 max-w-[200px]">
                                <p class="text-[10px] font-bold text-slate-500 line-clamp-2 leading-relaxed tracking-tight">{{ $anak->alamat }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @can('update anak')
                                <div class="flex justify-center">
                                    <label class="relative inline-flex items-center cursor-pointer group">
                                        <input type="checkbox" class="sr-only peer status-toggle" 
                                               data-id="{{ $anak->id }}" {{ $anak->status === 'aktif' ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 shadow-sm"></div>
                                    </label>
                                </div>
                                @else
                                <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $anak->status === 'aktif' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-slate-50 text-slate-400 border-slate-100' }}">
                                    {{ $anak->status }}
                                </span>
                                @endcan
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    @can('show anak')
                                    <a href="{{ route('anak.show', $anak->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100" title="Profil Pasien">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    </a>
                                    @endcan
                                    
                                    @can('update anak')
                                    <a href="{{ route('anak.edit', $anak->id) }}" class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-500 hover:text-white transition-all border border-amber-100 shadow-sm" title="Ubah Data">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    </a>
                                    @endcan
    
                                    @can('delete anak')
                                    <form action="{{ route('anak.destroy', $anak->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all border border-red-100 btn-hapus shadow-sm" data-name="{{ $anak->nama }}" title="Hapus Data">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <i data-lucide="user-x" class="w-12 h-12 text-slate-200"></i>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada data pasien</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Card List --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse ($anaks as $anak)
            <div class="p-6 space-y-5 bg-white hover:bg-slate-50/50 transition-colors">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl border-2 border-slate-100 overflow-hidden shrink-0 shadow-sm">
                            <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/images/faces/face1.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-800 uppercase italic tracking-tight leading-tight">{{ $anak->nama }}</h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">NIB: {{ $anak->nib ?? '-' }}</p>
                            <div class="mt-2">
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[9px] font-black uppercase tracking-tight border border-slate-200 italic">
                                    {{ $anak->usia }} Tahun
                                </span>
                            </div>
                        </div>
                    </div>
                    @can('update anak')
                    <div class="pt-1">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer status-toggle" 
                                   data-id="{{ $anak->id }}" {{ $anak->status === 'aktif' ? 'checked' : '' }}>
                            <div class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                        </label>
                    </div>
                    @endcan
                </div>

                @if($anak->active_packages->count() > 0)
                <div class="p-4 bg-red-50 rounded-2xl border border-red-100">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-[9px] font-black text-red-400 uppercase tracking-widest">Progress Paket</p>
                        <i data-lucide="bar-chart-3" class="w-3.5 h-3.5 text-red-400"></i>
                    </div>
                    <button @click="openProgress('{{ addslashes($anak->nama) }}', {{ $anak->packages_data->toJson() }})" 
                            class="w-full text-left">
                        <span class="text-[11px] font-black text-red-600 uppercase tracking-tight">{{ $anak->active_packages->count() }} Paket Sedang Berjalan</span>
                        <div class="w-full h-1.5 bg-red-100 rounded-full mt-2 overflow-hidden">
                            <div class="h-full bg-red-500 rounded-full w-2/3 animate-pulse"></div>
                        </div>
                    </button>
                </div>
                @endif

                <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                    <div class="flex items-center gap-2">
                        @can('show anak')
                        <a href="{{ route('anak.show', $anak->id) }}" class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center border border-blue-100 shadow-sm">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                        @endcan
                        
                        @can('update anak')
                        <a href="{{ route('anak.edit', $anak->id) }}" class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center border border-amber-100 shadow-sm">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
                        @endcan

                        @can('delete anak')
                        <form action="{{ route('anak.destroy', $anak->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center border border-red-100 btn-hapus" data-name="{{ $anak->nama }}">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                        @endcan
                    </div>
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $anak->telepon_ibu ?? $anak->telepon_ayah ?? '')) }}" target="_blank" 
                       class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center border border-emerald-100 shadow-sm">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="p-20 text-center space-y-3">
                <i data-lucide="user-x" class="w-12 h-12 text-slate-100 mx-auto"></i>
                <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada data pasien</p>
            </div>
            @endforelse
        </div>
        
        <div class="p-6 bg-slate-50/50 border-t border-slate-100">
            <div class="overflow-x-auto max-w-full flex justify-start md:justify-center custom-scrollbar pb-2 px-2">
                {{ $anaks->fragment('judul')->links() }}
            </div>
        </div>
    </div>
    
    {{-- Modal Progress --}}
    <div x-show="showProgressModal" 
         class="fixed inset-0 z-[999] flex items-center justify-center px-4 overflow-hidden"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showProgressModal = false"></div>
        
        <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden animate-in zoom-in-95 duration-300"
             @click.away="showProgressModal = false">
            
            <!-- Modal Header -->
            <div class="bg-gradient-to-br from-red-500 to-red-600 px-10 py-8 relative text-white">
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-80 mb-1">Rincian Progress Paket</p>
                    <h3 class="text-2xl font-black tracking-tight" x-text="selectedAnakName"></h3>
                </div>
                <i data-lucide="activity" class="w-32 h-32 text-white/10 absolute -right-6 -bottom-6 rotate-12"></i>
                <button @click="showProgressModal = false" type="button" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors z-50 p-2">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-10 py-10 space-y-8 max-h-[60vh] overflow-y-auto custom-scrollbar">
                <template x-for="(pkg, index) in selectedPackages" :key="index">
                    <div class="space-y-4 p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight" x-text="pkg.label"></h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase mt-0.5 tracking-widest" x-text="`Sesi: ${pkg.used} / ${pkg.total}`"></p>
                            </div>
                            <span class="text-lg font-black text-red-500" x-text="`${pkg.percent}%`"></span>
                        </div>
                        
                        <div class="w-full h-3 bg-white rounded-full overflow-hidden border border-slate-100">
                            <div class="h-full bg-red-500 rounded-full shadow-[0_0_12px_rgba(239,68,68,0.3)] transition-all duration-1000" 
                                 :style="`width: ${pkg.percent}%`"
                                 x-init="setTimeout(() => $el.style.width = pkg.percent + '%', 100)"></div>
                        </div>

                        <div class="flex justify-between items-center text-[9px] font-black text-slate-400 uppercase tracking-widest">
                            <span x-text="`${pkg.total - pkg.used} Sesi Tersisa`"></span>
                            <span x-text="pkg.percent === 100 ? 'Selesai' : 'Berjalan'"></span>
                        </div>
                    </div>
                </template>
                
                <template x-if="selectedPackages.length === 0">
                    <div class="py-12 text-center text-slate-300 italic font-bold">
                        Tidak ada paket aktif yang ditemukan
                    </div>
                </template>
            </div>

            <!-- Modal Footer -->
            <div class="px-10 py-6 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button @click="showProgressModal = false" 
                        class="bg-white border border-slate-200 text-slate-600 py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-100 transition-all">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // AJAX Status Toggle Logic
        $('.status-toggle').on('change', function() {
            const anakId = $(this).data('id');
            const state = $(this).is(':checked');

            $.ajax({
                url: "{{ route('anak.status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: anakId,
                    status: state ? 'aktif' : 'nonaktif'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Toast.fire({ icon: 'success', title: 'Status berhasil diperbarui' });
                    } else {
                        Toast.fire({ icon: 'error', title: 'Gagal memperbarui status' });
                    }
                },
                error: function() {
                    Toast.fire({ icon: 'error', title: 'Terjadi kesalahan sistem' });
                }
            });
        });

        // SweetAlert Delete Confirmation
        $('.btn-hapus').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const name = $(this).data('name');

            Swal.fire({
                title: 'Hapus Data Anak?',
                text: "Anda akan menghapus data " + name + ". Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, Hapus Data!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2rem] border-none shadow-2xl',
                    confirmButton: 'rounded-xl px-6 py-3 text-xs font-black uppercase tracking-widest',
                    cancelButton: 'rounded-xl px-6 py-3 text-xs font-black uppercase tracking-widest text-slate-500'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
