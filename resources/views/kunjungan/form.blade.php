@csrf
<div class="space-y-6">
    {{-- Terapis Info (read-only) --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis Pelaksana</label>
        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <i data-lucide="user-check" class="w-4 h-4 text-emerald-500"></i>
            <span class="text-sm font-black text-slate-700 uppercase">{{ $kunjungan->terapis->nama }}</span>
        </div>
        <input type="hidden" name="kunjungan_id" value="{{ $kunjungan->id }}">
    </div>

    {{-- Program Items --}}
    <div id="form-wrapper" class="space-y-4">
        <div class="container-form space-y-4">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Program Terapi <span class="text-red-500">*</span></label>
                    <select class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none select2" name="program_id[0]">
                        @foreach ($program as $p)
                            <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" id="add-button" class="shrink-0 mt-5 flex items-center gap-2 px-4 py-3 bg-slate-900 hover:bg-black text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah
                </button>
            </div>

            {{-- Skala Radio --}}
            <div class="flex flex-wrap gap-3">
                <label for="status_dp_0" class="flex-1 cursor-pointer group">
                    <input type="radio" id="status_dp_0" name="status[0]" value="dp" required class="sr-only peer">
                    <div class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl peer-checked:border-red-500 peer-checked:bg-red-500 peer-checked:text-white transition-all shadow-sm group-hover:bg-slate-100">
                        <span class="text-xs font-black uppercase tracking-widest">DP</span>
                    </div>
                </label>
                <label for="status_ds_0" class="flex-1 cursor-pointer group">
                    <input type="radio" id="status_ds_0" name="status[0]" value="ds" class="sr-only peer">
                    <div class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl peer-checked:border-amber-500 peer-checked:bg-amber-500 peer-checked:text-white transition-all shadow-sm group-hover:bg-slate-100">
                        <span class="text-xs font-black uppercase tracking-widest">DS</span>
                    </div>
                </label>
                <label for="status_tb_0" class="flex-1 cursor-pointer group">
                    <input type="radio" id="status_tb_0" name="status[0]" value="tb" class="sr-only peer">
                    <div class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl peer-checked:border-emerald-500 peer-checked:bg-emerald-500 peer-checked:text-white transition-all shadow-sm group-hover:bg-slate-100">
                        <span class="text-xs font-black uppercase tracking-widest">TB</span>
                    </div>
                </label>
            </div>
        </div>
    </div>

    {{-- Keterangan --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan & Keterangan <span class="text-red-500">*</span></label>
        <textarea name="keterangan" rows="4" required
                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none placeholder:text-slate-300"
                  placeholder="Tuliskan catatan perkembangan pasien..."></textarea>
        @error('keterangan')
            <p class="text-[10px] font-black text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Actions --}}
    <div class="flex justify-end gap-3 pt-4 border-t border-slate-50">
        <a href="{{ url()->previous() }}" class="px-8 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</a>
        <button type="submit" class="px-12 py-3 bg-slate-900 hover:bg-black text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl transition-all">{{ $tombol }}</button>
    </div>
</div>
