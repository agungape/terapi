@extends('layouts.master')
@section('title', 'Pengaturan Sistem')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Sistem</span>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Pengaturan</span>
        </div>
    </div>

    @if ($profile)
    <form action="{{ route('profile.update', ['profile' => $profile->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Branding & Theme -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-8">
                <!-- Logo Card -->
                <div class="card-premium p-8 bg-white text-center relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-slate-50/50 rounded-full group-hover:bg-slate-50 transition-colors duration-500"></div>
                    
                    <h3 class="relative z-10 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 italic">Logo Resmi Institusi</h3>
                    
                    <div class="relative z-10 mx-auto w-48 h-48 rounded-[40px] bg-slate-50 border-2 border-dashed border-slate-200 p-2 group-hover:border-primary-200 transition-all duration-500">
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
                        <label for="logo" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-primary-600 text-white py-3 px-6 rounded-2xl text-[10px] font-black uppercase tracking-widest cursor-pointer transition-all shadow-xl shadow-slate-200">
                            <i data-lucide="upload-cloud" class="w-4 h-4"></i> Pilih Gambar Baru
                        </label>
                        <input type="file" id="logo" name="logo" class="hidden" accept="image/*">
                    </div>
                </div>

                <!-- Color Theme Card -->
                <div class="card-premium p-8 bg-white overflow-hidden relative group">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                        <i data-lucide="palette" class="w-4 h-4 text-primary-500"></i> Kustomisasi Tema
                    </h3>

                    <div class="space-y-6">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Warna Primer Aplikasi</label>
                            <div class="flex items-center gap-4">
                                <div class="relative w-16 h-16 rounded-2xl border-4 border-white shadow-lg overflow-hidden shrink-0">
                                    <input type="color" name="warna_primer" id="color-picker" 
                                           value="{{ $profile->warna_primer ?? '#ef4444' }}" 
                                           class="absolute -inset-2 w-[150%] h-[150%] cursor-pointer border-none p-0">
                                </div>
                                <div class="flex-1">
                                    <input type="text" id="color-hex" value="{{ $profile->warna_primer ?? '#ef4444' }}" 
                                           class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-2 text-xs font-bold text-slate-600 focus:ring-2 focus:ring-primary-50 outline-none uppercase" 
                                           readonly>
                                    <p class="text-[9px] text-slate-400 font-bold mt-2 uppercase tracking-tighter italic">Warna ini akan digunakan untuk tombol, ikon, dan aksen navigasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Administrative Details -->
            <div class="lg:col-span-8">
                <div class="card-premium bg-white">
                    <div class="p-8 border-b border-slate-50">
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em] flex items-center gap-3">
                            <i data-lucide="settings-2" class="w-5 h-5 text-primary-500"></i> Konfigurasi Identitas
                        </h3>
                    </div>
                    
                    <div class="p-8 space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Nama Yayasan -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Yayasan / Institusi</label>
                                <div class="relative">
                                    <i data-lucide="building-2" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="nama" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-primary-50 transition-all border border-slate-100 shadow-inner" 
                                           value="{{ $profile->nama }}" placeholder="Masukkan Nama Yayasan">
                                </div>
                            </div>

                            <!-- Nama Aplikasi -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Aplikasi / Branding</label>
                                <div class="relative">
                                    <i data-lucide="terminal" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="nama_apk" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-primary-50 transition-all border border-slate-100 shadow-inner" 
                                           value="{{ $profile->nama_apk }}" placeholder="Masukkan Judul Aplikasi">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Resmi</label>
                                <div class="relative">
                                    <i data-lucide="mail" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="email" name="email" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-primary-50 transition-all border border-slate-100 shadow-inner" 
                                           value="{{ $profile->email }}" placeholder="official@yayasan.com">
                                </div>
                            </div>

                            <!-- Telepon -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Telepon / WhatsApp</label>
                                <div class="relative">
                                    <i data-lucide="phone" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="telepon" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-primary-50 transition-all border border-slate-100 shadow-inner" 
                                           value="{{ $profile->telepon }}" placeholder="08XXXXXXXXXX">
                                </div>
                            </div>
                        </div>

                        <!-- Kepala Yayasan -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kepala Yayasan / Direktur Utama</label>
                            <div class="relative">
                                <i data-lucide="user-check" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                <input type="text" name="ketua" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-3.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-primary-50 transition-all border border-slate-100 shadow-inner" 
                                       value="{{ $profile->ketua }}" placeholder="Nama Kepala Yayasan Lengkap">
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Kantor Pusat</label>
                            <div class="relative">
                                <i data-lucide="map-pin" class="w-4 h-4 absolute left-4 top-4 text-slate-300"></i>
                                <textarea name="alamat" rows="4" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-4 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-primary-50 transition-all border border-slate-100 shadow-inner resize-none" placeholder="Alamat Lengkap Yayasan...">{{ $profile->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-slate-50 flex justify-end">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-4 px-10 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] shadow-xl shadow-red-100 transition-all flex items-center gap-3">
                                <i data-lucide="save" class="w-4 h-4"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="card-premium p-12 bg-white flex flex-col items-center justify-center text-center">
        <div class="w-20 h-20 bg-slate-50 rounded-[40px] flex items-center justify-center text-slate-400 mb-6">
            <i data-lucide="alert-circle" class="w-10 h-10"></i>
        </div>
        <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-2">Profil Belum Dikonfigurasi</h4>
        <p class="text-[11px] text-slate-400 font-bold max-w-sm mb-8 leading-relaxed italic">Silakan hubungi administrator sistem untuk menginisialisasi profil yayasan.</p>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // Image Preview Logic
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

        // Color Picker Logic
        const colorPicker = document.getElementById('color-picker');
        const colorHex = document.getElementById('color-hex');

        if (colorPicker) {
            colorPicker.addEventListener('input', function() {
                colorHex.value = this.value.toUpperCase();
            });
        }
    });
</script>
@endsection
