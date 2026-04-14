@csrf
<div class="space-y-6">
    {{-- Terapis (Read-only) --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis Pelaksana</label>
        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <i data-lucide="stethoscope" class="w-4 h-4 text-blue-500"></i>
            <span class="text-sm font-black text-slate-700 uppercase">{{ $kunjungan->terapis->nama }}</span>
        </div>
        <input type="hidden" name="kunjungan_id" value="{{ $kunjungan->id }}">
    </div>

    {{-- Program Items --}}
    <div id="form-fisioterapi" class="space-y-4">
        <div class="container-form space-y-4">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Program Fisioterapi <span class="text-red-500">*</span></label>
                    <select class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none select2" name="program_id[0]">
                        @foreach ($program_fisioterapi as $f)
                            <option value="{{ $f->id }}">{{ $f->deskripsi }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" id="add-button-fisioterapi" class="shrink-0 mt-5 flex items-center gap-2 px-4 py-3 bg-slate-900 hover:bg-black text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah
                </button>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Aktivitas Terapi</label>
                <textarea name="aktivitas_terapi[0]" rows="3"
                          class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none resize-none placeholder:text-slate-300"
                          placeholder="Deskripsikan aktivitas terapi yang dilakukan..."></textarea>
                @error('aktivitas_terapi') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Evaluasi --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Evaluasi Sesi</label>
        <textarea name="evaluasi" rows="3"
                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none resize-none placeholder:text-slate-300"
                  placeholder="Evaluasi perkembangan fisioterapi..."></textarea>
        @error('evaluasi') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Catatan Khusus --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan Khusus</label>
        <textarea name="catatan_khusus" rows="3"
                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none resize-none placeholder:text-slate-300"
                  placeholder="Catatan kondisi khusus pasien..."></textarea>
        @error('catatan_khusus') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Actions --}}
    <div class="flex justify-end gap-3 pt-4 border-t border-slate-50">
        <a href="{{ url()->previous() }}" class="px-8 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</a>
        <button type="submit" class="px-12 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl transition-all">{{ $tombol }}</button>
    </div>
</div>
