<div class="p-8 space-y-6">
    @if($pemasukkan->kunjungans->isEmpty())
        <div class="text-center py-12 space-y-3">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto text-slate-200">
                <i data-lucide="calendar-x" class="w-8 h-8"></i>
            </div>
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic">Belum ada pemakaian sesi untuk kwitansi ini.</p>
        </div>
    @else
        <div class="space-y-4">
            <div class="flex items-center justify-between px-2">
                <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Daftar Kehadiran / Pemakaian</h6>
                <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-tighter italic">
                    {{ $pemasukkan->sudah_terpakai }} / {{ ($pemasukkan->Tarif->jumlah_pertemuan ?? $pemasukkan->tarif->jumlah_pertemuan) ?? 0 }} Sesi
                </span>
            </div>

            <div class="divide-y divide-slate-100 bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm">
                @foreach($pemasukkan->kunjungans as $kunjungan)
                    <div class="p-5 flex items-center justify-between hover:bg-slate-50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex flex-col items-center justify-center text-slate-500 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                                <span class="text-[8px] font-black uppercase leading-none">{{ $kunjungan->created_at->format('M') }}</span>
                                <span class="text-xs font-black leading-none">{{ $kunjungan->created_at->format('d') }}</span>
                            </div>
                            <div>
                                <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $kunjungan->created_at->format('H:i') }} WIB</h4>
                                <p class="text-[9px] font-bold text-slate-400 uppercase flex items-center gap-1 mt-0.5">
                                    <i data-lucide="user" class="w-2.5 h-2.5"></i> 
                                    @if($kunjungan->terapis)
                                        {{ $kunjungan->terapis->nama }}
                                    @else
                                        Terapis belum ditentukan
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest italic
                                {{ in_array($kunjungan->status, ['hadir', 'izin_hangus']) ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                {{ str_replace('_', ' ', $kunjungan->status) }}
                            </span>
                            @if(in_array($kunjungan->status, ['hadir', 'izin_hangus']))
                                <p class="text-[8px] font-black text-emerald-400 uppercase mt-1">Sesi Terpotong</p>
                            @else
                                <p class="text-[8px] font-black text-slate-300 uppercase mt-1">Sesi Tidak Terpotong</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<div class="bg-slate-50 p-6 border-t border-slate-100 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-emerald-500">
            <i data-lucide="info" class="w-4 h-4"></i>
        </div>
        <p class="text-[9px] font-bold text-slate-400 leading-tight uppercase">
            Data ini sinkron otomatis dengan <br> <span class="text-slate-600">Riwayat Terapi Anak</span>
        </p>
    </div>
    <button type="button" @click="closeModal()" class="px-6 py-3 bg-white border border-slate-200 text-slate-500 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-100 transition-all">Tutup</button>
</div>
