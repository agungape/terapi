@extends('layouts.master')
@section('title', isset($psikolog) ? 'Edit Psikolog' : 'Tambah Psikolog')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <div class="flex items-center justify-between">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="{{ route('psikolog.index') }}" class="hover:text-red-500 transition-colors">Psikolog</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span>{{ isset($psikolog) ? 'Edit' : 'Tambah' }}</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">
                {{ isset($psikolog) ? 'Update Data Psikolog' : 'Registrasi Psikolog Baru' }}
            </h2>
        </div>
        <a href="{{ route('psikolog.index') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 rounded-xl text-xs font-bold transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="max-w-2xl">
        <div class="card-premium overflow-hidden">
            <div class="p-6 border-b border-slate-50 bg-slate-50">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                    <i data-lucide="brain" class="w-4 h-4 text-red-500"></i> DATA PSIKOLOG
                </h3>
            </div>

            <div class="p-8">
                @csrf
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nama Lengkap (termasuk Gelar) <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required autofocus
                               value="{{ old('nama') ?? ($psikolog->nama ?? '') }}"
                               placeholder="Contoh: dr. Budi Santoso, M.Psi"
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none @error('nama') ring-2 ring-red-300 @enderror">
                        @error('nama') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nomor STR</label>
                            <input type="text" name="str"
                                   value="{{ old('str') ?? ($psikolog->str ?? '') }}"
                                   placeholder="Contoh: XP000010..."
                                   class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none @error('str') ring-2 ring-red-300 @enderror">
                            @error('str') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nomor SIPP</label>
                            <input type="text" name="sipp"
                                   value="{{ old('sipp') ?? ($psikolog->sipp ?? '') }}"
                                   placeholder="Contoh: 20130221..."
                                   class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none @error('sipp') ring-2 ring-red-300 @enderror">
                            @error('sipp') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Alamat Praktik</label>
                        <textarea name="alamat" rows="3" placeholder="Alamat lengkap klinik atau tempat praktik..."
                                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none resize-none @error('alamat') ring-2 ring-red-300 @enderror">{{ old('alamat') ?? ($psikolog->alamat ?? '') }}</textarea>
                        @error('alamat') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nomor Telepon</label>
                        <input type="text" name="telepon"
                               value="{{ old('telepon') ?? ($psikolog->telepon ?? '') }}"
                               placeholder="08xx-xxxx-xxxx"
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none @error('telepon') ring-2 ring-red-300 @enderror">
                        @error('telepon') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-50">
                        <a href="{{ route('psikolog.index') }}" class="px-8 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</a>
                        <button type="submit" class="px-12 py-3 bg-red-500 hover:bg-red-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-red-100 transition-all italic">{{ $tombol }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });</script>
@endsection
