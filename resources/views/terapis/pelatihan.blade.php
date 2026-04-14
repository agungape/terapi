@extends('layouts.master')
@section('title', 'Tambah Pelatihan Terapis')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <div class="flex items-center justify-between">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="{{ route('terapis.index') }}" class="hover:text-red-500 transition-colors">Terapis</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span>Tambah Pelatihan</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Registrasi Pelatihan & Sertifikasi</h2>
        </div>
        <a href="{{ url()->previous() }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 rounded-xl text-xs font-bold transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="max-w-2xl">
        <div class="card-premium overflow-hidden">
            <div class="p-6 border-b border-slate-50 bg-slate-50">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                    <i data-lucide="award" class="w-4 h-4 text-red-500"></i> FORM DATA PELATIHAN
                </h3>
            </div>

            <div class="p-8">
                <form action="{{ route('pelatihans.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="terapis_id" value="{{ old('terapis_id') ?? ($terapi->id ?? '') }}">

                    @isset($terapi)
                    <input type="hidden" name="url_asal" value="{{ old('url_asal') ?? url()->previous() . '#row-' . $terapi->id }}">
                    @else
                    <input type="hidden" name="url_asal" value="{{ old('url_asal') ?? url()->previous() }}">
                    @endisset

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Pilih Pelatihan <span class="text-red-500">*</span></label>
                        <select name="pelatihan_id" required class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none select2" style="width:100%">
                            @forelse ($pelatihan as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @empty
                                <option disabled>Tidak ada data pelatihan tersedia</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Tanggal Pelatihan</label>
                        <input type="date" name="tanggal"
                               value="{{ old('tanggal') ?? ($terapispelatihan->tanggal ?? '') }}"
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none @error('tanggal') ring-2 ring-red-300 @enderror">
                        @error('tanggal') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Upload Sertifikat (PDF)</label>
                        <div class="relative">
                            <input type="file" name="sertifikat" id="sertifikat" accept="application/pdf"
                                   class="hidden" onchange="updateFileName(this)">
                            <label for="sertifikat" class="flex items-center gap-4 w-full bg-slate-50 border-2 border-dashed border-slate-200 hover:border-red-300 hover:bg-red-50/30 rounded-2xl px-5 py-6 cursor-pointer transition-all group">
                                <div class="w-10 h-10 bg-white rounded-xl border border-slate-200 flex items-center justify-center group-hover:border-red-200 transition-all">
                                    <i data-lucide="file-badge" class="w-5 h-5 text-slate-400 group-hover:text-red-500"></i>
                                </div>
                                <div>
                                    <p id="file-name" class="text-xs font-black text-slate-500 uppercase tracking-wide">Klik untuk pilih file PDF...</p>
                                    <p class="text-[10px] font-bold text-slate-400 mt-0.5">Format PDF, maksimum 5MB</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-50">
                        <a href="{{ url()->previous() }}" class="px-8 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</a>
                        <button type="submit" class="px-12 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-emerald-100 transition-all italic">Simpan Pelatihan</button>
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
    function updateFileName(input) {
        const fileName = input.files[0]?.name || 'Klik untuk pilih file PDF...';
        document.getElementById('file-name').textContent = fileName;
    }
</script>
@endsection
