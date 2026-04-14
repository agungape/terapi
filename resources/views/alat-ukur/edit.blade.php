@extends('layouts.master')
@section('title', isset($alatUkur) ? 'Edit Alat Ukur' : 'Tambah Alat Ukur')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <div class="flex items-center justify-between">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="{{ route('alat-ukur.index') }}" class="hover:text-red-500 transition-colors">Alat Ukur</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span>{{ isset($alatUkur) ? 'Edit' : 'Tambah' }}</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">
                {{ isset($alatUkur) ? 'Edit Data Alat Ukur' : 'Tambah Alat Ukur Baru' }}
            </h2>
        </div>
        <a href="{{ route('alat-ukur.index') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 rounded-xl text-xs font-bold transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="max-w-2xl">
        <div class="card-premium overflow-hidden">
            <div class="p-6 border-b border-slate-50 bg-slate-50">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                    <i data-lucide="ruler" class="w-4 h-4 text-red-500"></i> FORM ALAT UKUR PSIKOLOGIS
                </h3>
            </div>
            <div class="p-8">
                <form action="{{ isset($alatUkur) ? route('alat-ukur.update', $alatUkur->id) : route('alat-ukur.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if(isset($alatUkur)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nama Alat Ukur <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" required
                                   value="{{ old('nama', $alatUkur->nama ?? '') }}"
                                   placeholder="Contoh: Wechsler Intelligence Scale for Children"
                                   class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none @error('nama') ring-2 ring-red-300 @enderror">
                            @error('nama') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Singkatan</label>
                            <input type="text" name="singkatan"
                                   value="{{ old('singkatan', $alatUkur->singkatan ?? '') }}"
                                   placeholder="WISC-V"
                                   class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Domain Area <span class="text-red-500">*</span></label>
                        <select name="domain" required class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none @error('domain') ring-2 ring-red-300 @enderror">
                            <option value="">-- Pilih Domain --</option>
                            @foreach($domains as $key => $val)
                                <option value="{{ $key }}" {{ old('domain', $alatUkur->domain ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        @error('domain') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Rentang Usia (Bulan)</label>
                        <div class="flex items-center gap-3">
                            <input type="number" name="min_usia_bulan" placeholder="Min (opsional)"
                                   value="{{ old('min_usia_bulan', $alatUkur->min_usia_bulan ?? '') }}"
                                   class="flex-1 bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none">
                            <span class="text-sm font-black text-slate-400">—</span>
                            <input type="number" name="max_usia_bulan" placeholder="Max (opsional)"
                                   value="{{ old('max_usia_bulan', $alatUkur->max_usia_bulan ?? '') }}"
                                   class="flex-1 bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none">
                        </div>
                        <p class="text-[10px] font-bold text-slate-400">Kosongkan jika berlaku untuk semua usia</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Deskripsi & Kegunaan</label>
                        <textarea name="deskripsi" rows="3" placeholder="Jelaskan deskripsi singkat atau peruntukan alat ukur ini..."
                                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none resize-none">{{ old('deskripsi', $alatUkur->deskripsi ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" name="is_active" value="1" id="is_active"
                                       {{ old('is_active', $alatUkur->is_active ?? true) ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-checked:bg-emerald-500 rounded-full transition-colors peer-focus:ring-4 peer-focus:ring-emerald-50"></div>
                                <div class="absolute top-[2px] left-[2px] w-5 h-5 bg-white rounded-full transition-all peer-checked:translate-x-5 shadow-sm"></div>
                            </div>
                            <span class="text-xs font-black text-slate-700 uppercase tracking-wide">Aktif (tersedia di form pemeriksaan)</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-50">
                        <a href="{{ route('alat-ukur.index') }}" class="px-8 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</a>
                        <button type="submit" class="px-12 py-3 bg-red-500 hover:bg-red-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-red-100 transition-all italic">
                            {{ isset($alatUkur) ? 'Perbarui' : 'Simpan Alat Ukur' }}
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
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
</script>
@endsection
