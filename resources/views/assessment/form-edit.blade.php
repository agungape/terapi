<div x-data="{ 
    step: 1, 
    totalSteps: 5,
    nextStep() { if(this.step < this.totalSteps) this.step++; window.scrollTo({top: 0, behavior: 'smooth'}); },
    prevStep() { if(this.step > 1) this.step--; window.scrollTo({top: 0, behavior: 'smooth'}); }
}" class="space-y-6">

    <!-- Wizard Progress Indicator -->
    <div class="card-premium mb-8 p-6 shadow-sm overflow-hidden relative">
        <div class="absolute top-0 left-0 h-1 bg-amber-500 transition-all duration-500" :style="'width: ' + (step/totalSteps * 100) + '%'"></div>
        
        <div class="flex items-center justify-between relative z-10">
            <template x-for="i in totalSteps">
                <div class="flex flex-col items-center gap-2 flex-1 relative">
                    <!-- Connector Line -->
                    <div x-show="i < totalSteps" class="absolute top-5 left-[50%] w-full h-px bg-slate-100 -z-0"></div>
                    
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-xs transition-all border-2 z-10"
                         :class="step >= i ? 'bg-amber-500 border-amber-500 text-white shadow-lg shadow-amber-100' : 'bg-white border-slate-100 text-slate-300'">
                        <span x-text="i"></span>
                    </div>
                    <span class="text-[9px] font-black uppercase tracking-widest text-center"
                          :class="step === i ? 'text-amber-500' : 'text-slate-400'">
                        <template x-if="i === 1"><span>Identitas</span></template>
                        <template x-if="i === 2"><span>Observasi</span></template>
                        <template x-if="i === 3"><span>Diagnosa</span></template>
                        <template x-if="i === 4"><span>Saran</span></template>
                        <template x-if="i === 5"><span>Final</span></template>
                    </span>
                </div>
            </template>
        </div>
    </div>

    <form method="POST" action="{{ route('assessment.update', $assessment->id) }}" enctype="multipart/form-data" id="assessmentForm">
        @csrf
        @method('PATCH')

        <div class="tab-content relative">
            <!-- Step 1: Identitas -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="card-premium">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <i data-lucide="user-circle" class="w-5 h-5"></i>
                        </div>
                        <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">I. Identitas & Data Klien</h5>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="nama_anak" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                        <i data-lucide="smile" class="w-4 h-4 text-slate-400"></i> Nama Anak <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="hidden" name="anak_id" id="select-anak" value="{{ $assessment->anak_id }}">
                                        <input type="text" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 text-slate-500 cursor-not-allowed font-bold" value="{{ $assessment->anak->nama }}" readonly>
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300">
                                            <i data-lucide="lock" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                    @error('anak_id')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                <div>
                                    <label for="psikolog_id" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                        <i data-lucide="user" class="w-4 h-4 text-slate-400"></i> Psikolog Pemeriksa <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="hidden" name="psikolog_id" value="{{ $assessment->psikolog_id }}">
                                        <input type="text" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 text-slate-500 cursor-not-allowed font-bold" value="{{ $assessment->psikolog->nama }}" readonly>
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300">
                                            <i data-lucide="lock" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                    @error('psikolog_id')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label for="tanggal_assessment" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                        <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i> Tanggal Pemeriksaan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 @error('tanggal_assessment') border-red-500 @enderror" name="tanggal_assessment" id="tanggal_assessment" value="{{ old('tanggal_assessment', $assessment->tanggal_assessment->format('Y-m-d')) }}" required>
                                    @error('tanggal_assessment')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                                </div>

                                <div>
                                    <p class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                        <i data-lucide="history" class="w-4 h-4 text-slate-400"></i> Riwayat Anamnesa (Wawancara)
                                    </p>
                                    <div id="wawancara-container" class="border border-slate-200 rounded-xl p-4 bg-slate-50 text-sm string text-slate-500 min-h-[15rem] overflow-y-auto">
                                        <div class="text-center text-slate-400 flex flex-col items-center justify-center h-full">
                                            <i data-lucide="info" class="w-6 h-6 mb-2 text-slate-300"></i>
                                            Memuat riwayat wawancara...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="tujuan_pemeriksaan" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                    <i data-lucide="target" class="w-4 h-4 text-slate-400"></i> Tujuan Pemeriksaan <span class="text-red-500">*</span>
                                </label>
                                <textarea class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 form-control @error('tujuan_pemeriksaan') border-red-500 @enderror" id="tujuan_pemeriksaan" name="tujuan_pemeriksaan" rows="2" required>{{ old('tujuan_pemeriksaan', $assessment->tujuan_pemeriksaan) }}</textarea>
                            </div>
                            <div>
                                <label for="keluhan_utama" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                    <i data-lucide="message-square" class="w-4 h-4 text-slate-400"></i> Keluhan Utama
                                </label>
                                <textarea class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 form-control @error('keluhan_utama') border-red-500 @enderror" id="keluhan_utama" name="keluhan_utama" rows="2">{{ old('keluhan_utama', $assessment->keluhan_utama) }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="clipboard-list" class="w-4 h-4 text-slate-400"></i> Sumber Asesmen <span class="text-red-500">*</span>
                            </label>
                            <div id="sumber-asesmen-container" class="space-y-3">
                                @foreach ($assessment->sumber_asesmen as $index => $sumber)
                                <div class="relative mb-3 flex items-center">
                                    <input type="text" class="form-control input-sumber-asesmen w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12" name="sumber_asesmen[]" value="{{ old('sumber_asesmen.' . $index, $sumber) }}" required>
                                    <button class="btn-remove-sumber absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="btn-tambah-sumber" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Sumber
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Observasi -->
            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="card-premium">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                        <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </div>
                        <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">II. Hasil Observasi Perilaku</h5>
                    </div>
                    <div class="p-6 space-y-8">
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                                <i data-lucide="brain" class="w-4 h-4 text-emerald-500"></i> Observasi Status Klinis
                            </h6>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach([['mood_anak', 'smile', 'Mood Anak'], ['validitas_hasil', 'check-square', 'Validitas Hasil'], ['catatan_rapport', 'users', 'Catatan Rapport'], ['kontak_mata', 'eye', 'Kontak Mata'], ['komunikasi', 'message-circle', 'Komunikasi'], ['interaksi_sosial', 'handshake', 'Interaksi Sosial']] as $field)
                                <div>
                                    <label class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">{{ $field[2] }}</label>
                                    <input type="text" name="{{ $field[0] }}" value="{{ old($field[0], $assessment->{$field[0]}) }}" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Perilaku yang Teramati <span class="text-red-500">*</span></label>
                            <div id="perilaku-container" class="space-y-3">
                                @foreach ($assessment->observasi_awal as $index => $perilaku)
                                <div class="relative mb-3 flex items-center">
                                    <input type="text" class="form-control input-perilaku w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 pr-12" name="perilaku[]" value="{{ old('perilaku.' . $index, $perilaku) }}" required>
                                    <button class="btn-remove absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="btn-tambah-perilaku" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Perilaku
                            </button>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Kesimpulan Observasi <span class="text-red-500">*</span></label>
                            <textarea name="kesimpulan_observasi" rows="4" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500" required>{{ old('kesimpulan_observasi', $assessment->kesimpulan_observasi) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Diagnosa -->
            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="card-premium">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                        <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                            <i data-lucide="stethoscope" class="w-5 h-5"></i>
                        </div>
                        <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">III. Hasil Pemeriksaan & Diagnosa</h5>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Hasil Pemeriksaan <span class="text-red-500">*</span></label>
                            <div id="hasil-pemeriksaan-container" class="space-y-3">
                                @foreach ($assessment->hasil_pemeriksaan as $index => $hasil)
                                <div class="relative mb-3 flex items-start">
                                    <textarea class="form-control input-hasil-pemeriksaan w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 focus:border-purple-500 pr-12" name="hasil_pemeriksaan[]" rows="2" required>{{ old('hasil_pemeriksaan.' . $index, $hasil) }}</textarea>
                                    <button class="btn-remove-hasil absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="btn-tambah-hasil" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Hasil
                            </button>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Diagnosa Akhir <span class="text-red-500">*</span></label>
                            <textarea name="diagnosa" rows="4" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 focus:border-purple-500" required>{{ old('diagnosa', $assessment->diagnosa) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: Rekomendasi -->
            <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="card-premium">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                        <div class="p-2 bg-pink-100 text-pink-600 rounded-lg">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </div>
                        <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">IV. Rekomendasi Penanganan</h5>
                    </div>
                    <div class="p-6 space-y-8">
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Rekomendasi Keluarga <span class="text-red-500">*</span></label>
                            <div id="rekomendasi-orangtua-container" class="space-y-3">
                                @foreach ($assessment->rekomendasi_orangtua as $index => $rekomendasi)
                                <div class="relative mb-3 flex items-start">
                                    <textarea class="form-control input-rekomendasi w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-100 focus:border-pink-500 pr-12" name="rekomendasi_orangtua[]" rows="2" required>{{ old('rekomendasi_orangtua.' . $index, $rekomendasi) }}</textarea>
                                    <button class="btn-remove-rekomendasi absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="btn-tambah-orangtua" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Rekomendasi
                            </button>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Rekomendasi Terapi <span class="text-red-500">*</span></label>
                            <div id="rekomendasi-terapi-container" class="space-y-3">
                                @foreach ($assessment->rekomendasi_terapi as $index => $rekomendasi)
                                <div class="relative mb-3 flex items-start">
                                    <textarea class="form-control input-rekomendasi w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-100 focus:border-pink-500 pr-12" name="rekomendasi_terapi[]" rows="2" required>{{ old('rekomendasi_terapi.' . $index, $rekomendasi) }}</textarea>
                                    <button class="btn-remove-rekomendasi absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="btn-tambah-terapi" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Rekomendasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 5: Final -->
            <div x-show="step === 5" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="card-premium">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                        <div class="p-2 bg-slate-900 text-white rounded-lg">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                        </div>
                        <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">V. Finalisasi & Persetujuan</h5>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white relative overflow-hidden">
                            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                                <div class="space-y-2">
                                    <h4 class="text-lg font-black uppercase italic tracking-tight leading-none text-amber-400">Persetujuan Dokumen</h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Apakah Anda menyetujui seluruh hasil assessment ini?</p>
                                </div>
                                <div class="flex gap-4">
                                    <label class="cursor-pointer group">
                                        <input type="radio" id="persetujuan_ya" name="persetujuan_psikolog" value="1" class="hidden peer" {{ old('persetujuan_psikolog', $assessment->persetujuan_psikolog) ? 'checked' : '' }} required>
                                        <div class="px-8 py-3 rounded-2xl border-2 border-white/10 bg-white/5 text-xs font-black uppercase peer-checked:bg-amber-500 peer-checked:border-amber-500 transition-all">Setuju</div>
                                    </label>
                                    <label class="cursor-pointer group">
                                        <input type="radio" id="persetujuan_tidak" name="persetujuan_psikolog" value="0" class="hidden peer" {{ !old('persetujuan_psikolog', $assessment->persetujuan_psikolog) ? 'checked' : '' }}>
                                        <div class="px-8 py-3 rounded-2xl border-2 border-white/10 bg-white/5 text-xs font-black uppercase peer-checked:bg-red-500 peer-checked:border-red-500 transition-all">Tinjau Lagi</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="alasan-tidak-setuju-group" style="{{ !old('persetujuan_psikolog', $assessment->persetujuan_psikolog) ? '' : 'display: none;' }}" class="bg-red-50 border border-red-100 p-6 rounded-2xl">
                            <textarea name="alasan_tidak_setuju" rows="3" class="w-full border border-red-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-200 focus:border-red-500 bg-white" placeholder="Alasan peninjauan...">{{ old('alasan_tidak_setuju', $assessment->alasan_tidak_setuju) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Footer -->
        <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
            <button type="button" x-show="step > 1" @click="prevStep()" class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 py-4 px-10 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center gap-2 transition-all shadow-sm">
                <i data-lucide="chevron-left" class="w-4 h-4"></i> Kembali
            </button>
            <div x-show="step === 1" class="flex-1"></div>

            <button type="button" x-show="step < totalSteps" @click="nextStep()" class="bg-amber-500 hover:bg-amber-600 text-white py-4 px-12 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center gap-2 transition-all shadow-lg shadow-amber-200">
                Lanjutkan <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </button>

            <button type="submit" x-show="step === totalSteps" class="bg-emerald-500 hover:bg-emerald-600 text-white py-4 px-16 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center gap-2 transition-all shadow-lg shadow-emerald-200">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
