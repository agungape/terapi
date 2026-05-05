@extends('layouts.master')
@section('title', 'Manajemen Tarif & Paket')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500" 
     x-data="{ 
        showModal: false,
        modalMode: 'create', // 'create' or 'edit'
        modalTitle: '',
        formAction: '',
        
        // Form Data
        id: '',
        nama: '',
        deskripsi: '',
        tarif: '',
        jumlah_pertemuan: '',
        pertemuan_perilaku: '',
        pertemuan_fisioterapi: '',
        jenis_terapi: '',
        is_active: true,
        imagePreview: null,
        existingImage: null,

        init() {
            lucide.createIcons();
            @if ($errors->any())
                this.modalMode = '{{ old('id') ? 'edit' : 'create' }}';
                this.modalTitle = this.modalMode === 'edit' ? 'Edit Paket Terapi' : 'Tambah Paket Baru';
                this.formAction = this.modalMode === 'edit' ? `/tarif/{{ old('id') }}` : '{{ route('tarif.store') }}';
                
                this.id                    = '{{ old('id') }}';
                this.nama                  = '{{ old('nama') }}';
                this.deskripsi             = '{{ old('deskripsi') }}';
                this.tarif                 = '{{ old('tarif') }}';
                this.jumlah_pertemuan      = '{{ old('jumlah_pertemuan') }}';
                this.pertemuan_perilaku    = '{{ old('pertemuan_perilaku') }}';
                this.pertemuan_fisioterapi = '{{ old('pertemuan_fisioterapi') }}';
                this.jenis_terapi          = '{{ old('jenis_terapi') }}';
                this.is_active             = {{ old('is_active') ? 'true' : 'false' }};
                
                this.showModal = true;
            @endif
        },

        openCreate() {
            this.modalMode = 'create';
            this.modalTitle = 'Tambah Paket Baru';
            this.formAction = '{{ url('tarif') }}';
            this.resetForm();
            this.showModal = true;
        },

        openEdit(item) {
            this.modalMode = 'edit';
            this.modalTitle = 'Edit Paket Terapi';
            this.formAction = '{{ url('tarif') }}/' + item.id;
            
            this.id                    = item.id;
            this.nama                  = item.nama;
            this.deskripsi             = item.deskripsi;
            let rawTarif = Math.floor(parseFloat(item.tarif));
            this.tarif                 = this.formatNumber(rawTarif);
            this.jumlah_pertemuan      = item.jumlah_pertemuan;
            this.pertemuan_perilaku    = item.pertemuan_perilaku;
            this.pertemuan_fisioterapi = item.pertemuan_fisioterapi;
            this.jenis_terapi          = item.jenis_terapi;
            this.is_active             = item.is_active === 1 || item.is_active === true;
            this.existingImage         = item.gambar ? `/storage/tarif/${item.gambar}` : null;
            
            this.showModal = true;
        },

        resetForm() {
            this.id                    = '';
            this.nama                  = '';
            this.deskripsi             = '';
            this.tarif                 = '';
            this.jumlah_pertemuan      = '';
            this.pertemuan_perilaku    = '';
            this.pertemuan_fisioterapi = '';
            this.jenis_terapi          = '';
            this.is_active             = true;
            this.imagePreview          = null;
            this.existingImage         = null;
        },

        handleImageChange(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        formatPrice(e) {
            let val = e.target.value.replace(/[^\d]/g, '');
            this.tarif = this.formatNumber(val);
        },

        formatNumber(n) {
            if (!n) return '';
            // Pastikan hanya angka yang diproses
            let num = n.toString().replace(/[^\d]/g, '');
            return num.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
     }">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Portal</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Tarif & Layanan</span>
            </div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight italic uppercase">Katalog Paket <span class="text-red-500">Terapi</span></h1>
        </div>
        
        @can('create tarif')
        <button @click="openCreate()" class="bg-slate-900 hover:bg-red-600 text-white py-4 px-8 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center gap-3 transition-all shadow-xl shadow-slate-200 group">
            <i data-lucide="plus" class="w-4 h-4 group-hover:rotate-90 transition-transform"></i> Tambah Paket Baru
        </button>
        @endcan
    </div>

    <!-- Filter & Statistics -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-hide">
            {{-- Filter: tambah gabungan, assessment, observasi --}}
            @php $currentJenis = request('jenis', 'semua'); @endphp
            <a href="{{ route('tarif.index', ['jenis' => 'semua']) }}" 
               class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shrink-0 {{ $currentJenis == 'semua' ? 'bg-red-500 text-white shadow-lg shadow-red-200' : 'bg-white text-slate-400 border border-slate-100 hover:border-red-200 hover:text-red-500' }}">
                Semua Program
            </a>
            <a href="{{ route('tarif.index', ['jenis' => 'terapi_perilaku']) }}" 
               class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shrink-0 {{ $currentJenis == 'terapi_perilaku' ? 'bg-red-500 text-white shadow-lg shadow-red-200' : 'bg-white text-slate-400 border border-slate-100 hover:border-red-200 hover:text-red-500' }}">
                Terapi Perilaku
            </a>
            <a href="{{ route('tarif.index', ['jenis' => 'fisioterapi']) }}" 
               class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shrink-0 {{ $currentJenis == 'fisioterapi' ? 'bg-red-500 text-white shadow-lg shadow-red-200' : 'bg-white text-slate-400 border border-slate-100 hover:border-red-200 hover:text-red-500' }}">
                Fisioterapi
            </a>
            <a href="{{ route('tarif.index', ['jenis' => 'gabungan']) }}" 
               class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shrink-0 {{ $currentJenis == 'gabungan' ? 'bg-purple-500 text-white shadow-lg shadow-purple-200' : 'bg-white text-slate-400 border border-slate-100 hover:border-purple-200 hover:text-purple-500' }}">
                Paket Gabungan
            </a>
            <a href="{{ route('tarif.index', ['jenis' => 'assessment']) }}" 
               class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shrink-0 {{ $currentJenis == 'assessment' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'bg-white text-slate-400 border border-slate-100 hover:border-amber-200 hover:text-amber-500' }}">
                Assessment
            </a>
            <a href="{{ route('tarif.index', ['jenis' => 'observasi']) }}" 
               class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shrink-0 {{ $currentJenis == 'observasi' ? 'bg-teal-500 text-white shadow-lg shadow-teal-200' : 'bg-white text-slate-400 border border-slate-100 hover:border-teal-200 hover:text-teal-500' }}">
                Observasi
            </a>
        </div>

        <div class="hidden sm:flex items-center gap-6 text-[10px] font-black text-slate-400 uppercase tracking-widest bg-white px-6 py-3 rounded-xl border border-slate-100 shadow-sm">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>{{ $tarif->total() }} Total Paket</span>
            </div>
            <div class="w-px h-3 bg-slate-200"></div>
            <span>Page {{ $tarif->currentPage() }} of {{ $tarif->lastPage() }}</span>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse ($tarif as $t)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col relative">
            
            <!-- Quick Action Menu -->
            <div class="absolute top-4 right-4 z-10 flex gap-2">
                @can('update tarif')
                <button @click="openEdit({{ $t->toJson() }})" class="p-2.5 bg-white/90 backdrop-blur-sm text-amber-600 rounded-xl shadow-sm border border-slate-100 hover:bg-amber-600 hover:text-white transition-all duration-300">
                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                </button>
                @endcan
                @can('delete tarif')
                <form action="{{ route('tarif.destroy', $t->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2.5 bg-white/90 backdrop-blur-sm text-red-600 rounded-xl shadow-sm border border-slate-100 hover:bg-red-600 hover:text-white transition-all duration-300 btn-hapus" 
                            data-name="{{ $t->nama }}">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    </button>
                </form>
                @endcan
            </div>

            <!-- Card Image Area -->
            <div class="h-48 overflow-hidden relative bg-slate-100 shrink-0">
                @if($t->gambar)
                    <img src="{{ asset('storage/tarif/' . $t->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $t->nama }}">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 gap-3">
                        <i data-lucide="image" class="w-10 h-10 opacity-20"></i>
                        <span class="text-[9px] font-black uppercase tracking-widest opacity-50">No Brand Visual</span>
                    </div>
                @endif
                
                {{-- Category Badge --}}
                <div class="absolute bottom-4 left-4">
                    @if($t->jenis_terapi == 'terapi_perilaku')
                        <span class="px-3 py-1 bg-red-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">Behavioral</span>
                    @elseif($t->jenis_terapi == 'fisioterapi')
                        <span class="px-3 py-1 bg-blue-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">Physio</span>
                    @elseif($t->jenis_terapi == 'gabungan')
                        <span class="px-3 py-1 bg-purple-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">Gabungan</span>
                    @elseif($t->jenis_terapi == 'assessment')
                        <span class="px-3 py-1 bg-amber-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">Assessment</span>
                    @elseif($t->jenis_terapi == 'observasi')
                        <span class="px-3 py-1 bg-teal-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">Observasi</span>
                    @else
                        <span class="px-3 py-1 bg-slate-800 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">General</span>
                    @endif
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-8 flex-1 flex flex-col">
                <div class="mb-4">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight group-hover:text-red-500 transition-colors line-clamp-2 leading-snug">{{ $t->nama }}</h3>
                    <p class="text-[10px] font-bold text-slate-400 mt-2 line-clamp-3 leading-relaxed">{{ $t->deskripsi ?? 'Optimalisasi tumbuh kembang anak melalui sistem terapi terpadu dan personal.' }}</p>
                </div>

                <div class="mt-auto space-y-4">
                    <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-0.5">Quota Sesi</span>
                            @if($t->jenis_terapi === 'gabungan')
                                <span class="text-xs font-black text-slate-700 tracking-tight italic">
                                    {{ $t->pertemuan_perilaku }}P + {{ $t->pertemuan_fisioterapi }}F Pertemuan
                                </span>
                            @elseif(in_array($t->jenis_terapi, ['assessment','observasi']))
                                <span class="text-xs font-black text-slate-400 tracking-tight italic">Tanpa Sesi</span>
                            @else
                                <span class="text-xs font-black text-slate-700 tracking-tight italic">{{ $t->jumlah_pertemuan }} Pertemuan</span>
                            @endif
                        </div>
                        <div class="text-right">
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-0.5 block">Investasi</span>
                            <span class="text-lg font-black text-red-500 tracking-tighter">Rp {{ number_format($t->tarif, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if(!$t->is_active)
            <div class="absolute inset-0 bg-white/80 backdrop-blur-[2px] z-20 flex items-center justify-center">
                <span class="px-6 py-2 bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-full shadow-xl">Non-Aktif</span>
            </div>
            @endif
        </div>
        @empty
        <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-slate-100 shadow-sm border-dashed">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="package-search" class="w-10 h-10 text-slate-200"></i>
            </div>
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum ada paket terapi ditemukan</h3>
            <p class="text-xs text-slate-300 mt-2">Gunakan tombol 'Tambah Paket' untuk memulai layanan baru</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex justify-center pt-8">
        {{ $tarif->links() }}
    </div>

    <!-- Unified Modal -->
    <div x-show="showModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 overflow-hidden"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showModal = false"></div>
        
        <div class="relative bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl overflow-hidden animate-in zoom-in-95 duration-300 flex flex-col max-h-[90vh]">
            
            <!-- Modal Header -->
            <div class="bg-slate-900 px-10 py-10 shrink-0 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-50 mb-1" x-text="modalMode === 'create' ? 'Paket Baru' : 'Modifikasi Layanan'"></p>
                    <h3 class="text-2xl font-black tracking-tight italic uppercase" x-text="modalTitle"></h3>
                </div>
                <i data-lucide="settings" class="w-48 h-48 text-white/5 absolute -right-12 -top-12 rotate-12"></i>
                <button type="button" @click="showModal = false" class="absolute top-10 right-10 text-white/30 hover:text-white transition-colors cursor-pointer z-50">
                    <i data-lucide="x" class="w-6 h-6 pointer-events-none"></i>
                </button>
            </div>

            <!-- Modal Content (Scrollable) -->
            <div class="flex-1 overflow-y-auto custom-scrollbar">

                <form :action="formAction" method="POST" enctype="multipart/form-data" class="p-10 space-y-8">
                    @csrf
                    <template x-if="modalMode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <input type="hidden" name="id" x-model="id">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Image Input Area --}}
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Visual Produk</label>
                            <div class="relative h-48 rounded-3xl bg-slate-50 border-2 border-dashed border-slate-200 overflow-hidden group hover:border-red-200 transition-colors flex items-center justify-center">
                                
                                <template x-if="imagePreview">
                                    <img :src="imagePreview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!imagePreview && existingImage">
                                    <img :src="existingImage" class="w-full h-full object-cover opacity-60">
                                </template>
                                <template x-if="!imagePreview && !existingImage">
                                    <div class="flex flex-col items-center gap-2 group-hover:scale-110 transition-transform">
                                        <i data-lucide="image-plus" class="w-8 h-8 text-slate-300"></i>
                                        <span class="text-[9px] font-black text-slate-300 uppercase">Upload Icon/Foto</span>
                                    </div>
                                </template>

                                <input type="file" name="gambar" @change="handleImageChange" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                
                                <template x-if="imagePreview || existingImage">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-[9px] font-black uppercase pointer-events-none">
                                        Ganti Gambar
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Main Config --}}
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Paket</label>
                                <input type="text" name="nama" x-model="nama" required placeholder="Contoh: Paket 12 Sesi Hemat"
                                       class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none @error('nama') ring-2 ring-red-500 @enderror">
                                @error('nama') <p class="text-[9px] font-bold text-red-500 ml-2 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kategori Layanan</label>
                                <select name="jenis_terapi" x-model="jenis_terapi" required
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none appearance-none cursor-pointer @error('jenis_terapi') ring-2 ring-red-500 @enderror">
                                    <option value="" disabled>Pilih Kategori</option>
                                    <option value="terapi_perilaku">🧠 Terapi Perilaku</option>
                                    <option value="fisioterapi">🏃 Fisioterapi</option>
                                    <option value="gabungan">🔗 Gabungan (Fisio + Perilaku)</option>
                                    <option value="assessment">📋 Assessment</option>
                                    <option value="observasi">🔬 Observasi</option>
                                </select>
                                @error('jenis_terapi') <p class="text-[9px] font-bold text-red-500 ml-2 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Deskripsi & Keunggulan</label>
                        <textarea name="deskripsi" x-model="deskripsi" rows="3" placeholder="Apa saja yang didapatkan orang tua dan anak dalam paket ini?"
                                  class="w-full bg-slate-50 border-none rounded-3xl px-6 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none min-h-[100px]"></textarea>
                    </div>

                    {{-- Field Jumlah Pertemuan: hanya tampil untuk single jenis --}}
                    <template x-if="!['gabungan','assessment','observasi'].includes(jenis_terapi)">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nominal Investasi (Rp)</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-400">Rp</span>
                                    <input type="text" name="tarif" x-model="tarif" @input="formatPrice" required
                                           class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-6 py-4 text-sm font-black text-red-600 focus:ring-4 focus:ring-red-50 transition-all outline-none @error('tarif') ring-2 ring-red-500 @enderror">
                                    @error('tarif') <p class="text-[9px] font-bold text-red-500 ml-2 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Total Pertemuan</label>
                                <input type="text" inputmode="numeric" name="jumlah_pertemuan" x-model="jumlah_pertemuan"
                                       @input="jumlah_pertemuan = $event.target.value.replace(/[^0-9]/g, '')"
                                       onwheel="this.blur()"
                                       placeholder="mis. 20"
                                       class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-black focus:ring-4 focus:ring-red-50 transition-all outline-none @error('jumlah_pertemuan') ring-2 ring-red-500 @enderror">
                                @error('jumlah_pertemuan') <p class="text-[9px] font-bold text-red-500 ml-2 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </template>

                    {{-- Field Gabungan: tampil jika jenis = gabungan --}}
                    <template x-if="jenis_terapi === 'gabungan'">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nominal Investasi (Rp)</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-400">Rp</span>
                                    <input type="text" name="tarif" x-model="tarif" @input="formatPrice" required
                                           class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-6 py-4 text-sm font-black text-red-600 focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                </div>
                            </div>
                            <div class="p-5 bg-purple-50/50 rounded-2xl border border-purple-100">
                                <p class="text-[9px] font-black text-purple-500 uppercase tracking-widest mb-3">🔗 Kuota Sesi per Jenis</p>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="text-[9px] font-black text-slate-400 uppercase">Sesi Terapi Perilaku</label>
                                        <input type="text" inputmode="numeric"
                                               name="pertemuan_perilaku"
                                               x-model="pertemuan_perilaku"
                                               @input="pertemuan_perilaku = $event.target.value.replace(/[^0-9]/g, '')"
                                               onwheel="this.blur()"
                                               placeholder="mis. 10"
                                               class="w-full bg-white border border-purple-100 rounded-xl px-4 py-3 text-sm font-black text-purple-700 focus:ring-2 focus:ring-purple-200 outline-none">
                                        @error('pertemuan_perilaku') <p class="text-[9px] font-bold text-red-500">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[9px] font-black text-slate-400 uppercase">Sesi Fisioterapi</label>
                                        <input type="text" inputmode="numeric"
                                               name="pertemuan_fisioterapi"
                                               x-model="pertemuan_fisioterapi"
                                               @input="pertemuan_fisioterapi = $event.target.value.replace(/[^0-9]/g, '')"
                                               onwheel="this.blur()"
                                               placeholder="mis. 10"
                                               class="w-full bg-white border border-purple-100 rounded-xl px-4 py-3 text-sm font-black text-purple-700 focus:ring-2 focus:ring-purple-200 outline-none">
                                        @error('pertemuan_fisioterapi') <p class="text-[9px] font-bold text-red-500">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Field Assessment/Observasi: hanya nominal --}}
                    <template x-if="['assessment','observasi'].includes(jenis_terapi)">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nominal Investasi (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-400">Rp</span>
                                <input type="text" name="tarif" x-model="tarif" @input="formatPrice" required
                                       class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-6 py-4 text-sm font-black text-red-600 focus:ring-4 focus:ring-red-50 transition-all outline-none">
                            </div>
                            <p class="text-[9px] font-bold text-slate-400 ml-2">Layanan ini tidak memiliki sesi/pertemuan berkala.</p>
                        </div>
                    </template>

                    <div class="flex items-center gap-4 bg-slate-50 p-6 rounded-3xl">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" class="sr-only peer" :checked="is_active" @change="is_active = $event.target.checked">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                        </label>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Status Paket Aktif</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase">Paket yang tidak aktif tidak dapat dipilih saat pendaftaran</span>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 shrink-0 py-4">
                        <button type="button" @click="showModal = false" class="text-slate-500 py-4 px-8 text-xs font-black uppercase tracking-widest hover:text-slate-700 transition-colors cursor-pointer">Batal</button>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-4 px-12 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-red-200 transition-all flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-4 h-4"></i> Simpan Paket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // SweetAlert Delete Button
        $('.btn-hapus').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const name = $(this).data('name');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus paket '${name}'? Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2.5rem] border-none shadow-2xl',
                    confirmButton: 'rounded-xl font-bold uppercase text-[10px] tracking-widest px-8 py-4',
                    cancelButton: 'rounded-xl font-bold uppercase text-[10px] tracking-widest px-8 py-4 text-slate-500'
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
