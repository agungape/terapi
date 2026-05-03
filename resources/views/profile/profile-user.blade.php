@extends('layouts.master')
@section('title', 'Profil Saya')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Akun</span>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Profil Saya</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Informasi Personal</h2>
        </div>
    </div>

    @if ($terapis == null)
    <div class="card-premium p-12 bg-white flex flex-col items-center justify-center text-center">
        <div class="w-20 h-20 bg-slate-50 rounded-[40px] flex items-center justify-center text-slate-200 mb-6 border border-slate-100 italic">
            <i data-lucide="user-x" class="w-10 h-10"></i>
        </div>
        <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-2">Tampilan Khusus Terapis</h4>
        <p class="text-[11px] text-slate-400 font-bold max-w-sm mb-8 leading-relaxed italic">Halaman ini dirancang khusus untuk manajemen profil tenaga terapis medis.</p>
    </div>
    @else
    <form method="POST" action="{{ route('terapis.update', ['terapi' => $terapis->id]) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Sidebar: Avatar & Status -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-8">
                <div class="card-premium p-8 bg-white text-center relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-slate-50 rounded-full group-hover:bg-red-50 transition-colors duration-500"></div>
                    
                    <div class="relative z-10 mx-auto w-40 h-40 rounded-full bg-white p-1.5 shadow-xl shadow-slate-200 rotate-1 group-hover:rotate-0 transition-transform duration-500">
                        <div class="w-full h-full rounded-full overflow-hidden relative">
                            <img id="previewImage" 
                                 src="{{ asset($terapis->foto ? 'storage/terapis/' . $terapis->foto : 'assets/images/faces/face1.jpg') }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                 alt="Profile Avatar">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer" id="uploadTriggerIcon">
                                <i data-lucide="camera" class="w-8 h-8 text-white"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 space-y-4">
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $terapis->nama }}</h3>
                        <p class="text-[9px] font-black text-red-500 uppercase tracking-[0.2em] italic mb-6">Verified Practitioner</p>
                        
                        <div class="flex flex-col gap-3">
                            <label for="photoInput" class="bg-slate-900 hover:bg-red-500 text-white py-3 px-6 rounded-2xl text-[10px] font-black uppercase tracking-widest cursor-pointer transition-all">
                                <i data-lucide="upload" class="w-3.5 h-3.5 inline-block mr-2"></i> {{ $terapis->foto ? 'Ubah Foto Profil' : 'Upload Foto' }}
                            </label>
                            <input type="file" name="foto" id="photoInput" class="hidden" accept="image/*">
                            
                            @if ($terapis->foto)
                            <a href="{{ route('delete.fototerapis', $terapis->id) }}" class="text-[10px] font-black text-red-500 uppercase tracking-widest hover:text-red-700 transition-colors py-2">
                                <i data-lucide="trash-2" class="w-3 h-3 inline-block mr-1"></i> Hapus Foto
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-slate-50 flex items-center justify-center gap-6">
                        <div class="text-center">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</p>
                            <span class="px-2 py-0.5 bg-emerald-50 text-emerald-500 rounded text-[10px] font-black uppercase tracking-widest">Aktif</span>
                        </div>
                        <div class="w-px h-8 bg-slate-100"></div>
                        <div class="text-center">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">NIB</p>
                            <span class="text-[10px] font-black text-slate-800">{{ $terapis->nib ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden group">
                    <div class="relative z-10 space-y-4">
                        <i data-lucide="award" class="w-8 h-8 text-red-500"></i>
                        <p class="text-[10px] font-bold text-slate-400 leading-relaxed uppercase tracking-widest">Data yang Anda masukkan digunakan untuk administrasi laporan dan identitas pada sertifikat pelatihan.</p>
                    </div>
                    <div class="absolute -right-4 -bottom-4 text-white/5"><i data-lucide="user" class="w-24 h-24"></i></div>
                </div>
            </div>

            <!-- Form: Detail Biography -->
            <div class="lg:col-span-8">
                <div class="card-premium bg-white">
                    <div class="p-8 border-b border-slate-50">
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em] flex items-center gap-3">
                            <i data-lucide="user-edit" class="w-5 h-5 text-red-500"></i> Informasi Biografi
                        </h3>
                    </div>

                    <div class="p-8 space-y-8">
                        {{-- Data Hidden --}}
                        <input type="hidden" name="nib" value="{{ $terapis->nib }}">
                        <input type="hidden" name="status" value="{{ $terapis->status }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Nama Lengkap -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                                <div class="relative">
                                    <i data-lucide="user" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="nama" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-400 cursor-not-allowed italic" 
                                           value="{{ $terapis->nama }}" readonly>
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                                <div class="relative">
                                    <i data-lucide="calendar" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="date" name="tanggal_lahir" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                           value="{{ old('tanggal_lahir') ?? $terapis->tanggal_lahir }}">
                                </div>
                            </div>

                            <!-- Perguruan Tinggi -->
                            <div class="space-y-2 lg:col-span-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Almamater / Perguruan Tinggi</label>
                                <div class="relative">
                                    <i data-lucide="graduation-cap" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="perguruan_tinggi" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                           value="{{ old('perguruan_tinggi') ?? $terapis->perguruan_tinggi }}" placeholder="Contoh: Universitas Gadjah Mada">
                                </div>
                            </div>

                            <!-- Jurusan -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Bidang Keahlian / Jurusan</label>
                                <div class="relative">
                                    <i data-lucide="book-open" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="jurusan" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                           value="{{ old('jurusan') ?? $terapis->jurusan }}" placeholder="Contoh: Terapi Wicara">
                                </div>
                            </div>

                            <!-- Telepon -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor Kontak</label>
                                <div class="relative">
                                    <i data-lucide="smartphone" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="telepon" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                           value="{{ $terapis->telepon }}" placeholder="08XXXXXXXXXX">
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Domisili Saat Ini</label>
                            <div class="relative">
                                <i data-lucide="map-pin" class="w-4 h-4 absolute left-4 top-4 text-slate-300"></i>
                                <textarea name="alamat" rows="4" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-4 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100 resize-none" 
                                          placeholder="Alamat Lengkap Anda...">{{ $terapis->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-slate-50 flex justify-end gap-3">
                            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white py-4 px-10 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] shadow-xl shadow-primary-100 transition-all flex items-center gap-3">
                                <i data-lucide="save" class="w-4 h-4"></i> Update Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        const photoInput = document.getElementById('photoInput');
        const previewImage = document.getElementById('previewImage');
        const uploadTriggerIcon = document.getElementById('uploadTriggerIcon');

        if (photoInput && previewImage) {
            photoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            if (uploadTriggerIcon) {
                uploadTriggerIcon.addEventListener('click', () => photoInput.click());
            }
        }
    });
</script>
@endsection
