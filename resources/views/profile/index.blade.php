@extends('layouts.master')
@section('title', 'Dashboard Yayasan')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Pengaturan</span>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Profil Yayasan</span>
        </div>
    </div>

    @if ($profile)
    <form action="{{ route('profile.update', ['profile' => $profile->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Logo Upload Section -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-8">
                <div class="card-premium p-8 bg-white text-center relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-red-50/50 rounded-full group-hover:bg-red-50 transition-colors duration-500"></div>
                    
                    <h3 class="relative z-10 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 italic">Logo Resmi Institusi</h3>
                    
                    <div class="relative z-10 mx-auto w-48 h-48 rounded-[40px] bg-slate-50 border-2 border-dashed border-slate-200 p-2 group-hover:border-red-200 transition-all duration-500">
                        <div class="w-full h-full rounded-[32px] overflow-hidden bg-white shadow-inner flex items-center justify-center relative group/img">
                            <img id="preview" src="{{ asset('storage/logo/' . $profile->logo) }}" 
                                 class="w-full h-full object-contain p-4 group-hover/img:scale-105 transition-transform duration-700" 
                                 alt="Foundation Logo">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center">
                                <i data-lucide="camera" class="w-8 h-8 text-white"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 space-y-4">
                        <label for="logo" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-red-500 text-white py-3 px-6 rounded-2xl text-[10px] font-black uppercase tracking-widest cursor-pointer transition-all shadow-xl shadow-slate-200">
                            <i data-lucide="upload-cloud" class="w-4 h-4"></i> Pilih Gambar Baru
                        </label>
                        <input type="file" id="logo" name="logo" class="hidden" accept="image/*">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest italic leading-relaxed px-4">
                            Gunakan format PNG atau JPG dengan background transparan untuk hasil terbaik.
                        </p>
                    </div>
                </div>

                <div class="card-premium p-8 bg-slate-900 text-white overflow-hidden relative group">
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all duration-500">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-widest leading-none mb-1">Status Verifikasi</h4>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest tracking-tighter">Profil Aktif & Terverifikasi</p>
                        </div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 text-white/5 pointer-events-none group-hover:text-white/10 transition-colors">
                        <i data-lucide="home" class="w-24 h-24"></i>
                    </div>
                </div>
            </div>

            <!-- Settings Form Section -->
            <div class="lg:col-span-8">
                <div class="card-premium bg-white">
                    <div class="p-8 border-b border-slate-50">
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em] flex items-center gap-3">
                            <i data-lucide="settings-2" class="w-5 h-5 text-red-500"></i> Konfigurasi Identitas
                        </h3>
                    </div>
                    
                    <div class="p-8 space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Nama Yayasan -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Yayasan</label>
                                <div class="relative">
                                    <i data-lucide="building-2" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="nama" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                           value="{{ $profile->nama }}" placeholder="Masukkan Nama Yayasan">
                                </div>
                            </div>

                            <!-- Nama Aplikasi -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Aplikasi</label>
                                <div class="relative">
                                    <i data-lucide="terminal" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="nama_apk" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                           value="{{ $profile->nama_apk }}" placeholder="Masukkan Judul Aplikasi">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Resmi</label>
                                <div class="relative">
                                    <i data-lucide="mail" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="email" name="email" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                           value="{{ $profile->email }}" placeholder="official@yayasan.com">
                                </div>
                            </div>

                            <!-- Telepon -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Telepon / WhatsApp</label>
                                <div class="relative">
                                    <i data-lucide="phone" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="telepon" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                           value="{{ $profile->telepon }}" placeholder="08XXXXXXXXXX">
                                </div>
                            </div>
                        </div>

                        <!-- Kepala Yayasan -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kepala Yayasan / Direktur</label>
                            <div class="relative">
                                <i data-lucide="user-check" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                <input type="text" name="ketua" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100" 
                                       value="{{ $profile->ketua }}" placeholder="Nama Kepala Yayasan Lengkap">
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Kantor Pusat</label>
                            <div class="relative">
                                <i data-lucide="map-pin" class="w-4 h-4 absolute left-4 top-4 text-slate-300"></i>
                                <textarea name="alamat" rows="4" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-4 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all border border-slate-100 resize-none" placeholder="Alamat Lengkap Yayasan...">{{ $profile->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-slate-50 flex justify-end">
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-4 px-10 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] shadow-xl shadow-red-100 transition-all flex items-center gap-3">
                                <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <!-- Case for no profile record - Should use a similar layout but with store route -->
    <div class="card-premium p-12 bg-white flex flex-col items-center justify-center text-center">
        <div class="w-20 h-20 bg-red-50 rounded-[40px] flex items-center justify-center text-red-500 mb-6">
            <i data-lucide="alert-circle" class="w-10 h-10"></i>
        </div>
        <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-2">Profil Belum Dikonfigurasi</h4>
        <p class="text-[11px] text-slate-400 font-bold max-w-sm mb-8 leading-relaxed italic">Silakan hubungi administrator sistem atau buat profile baru jika akun Anda memiliki izin akses.</p>
        @can('create profile')
            <a href="{{ route('profile.create') }}" class="bg-red-500 hover:bg-red-600 text-white py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-red-100 transition-all">Inisialisasi Profil</a>
        @endcan
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        const logoInput = document.getElementById('logo');
        const preview = document.getElementById('preview');

        if (logoInput) {
            logoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection
