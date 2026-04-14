<div x-data="{ 
    step: 1, 
    totalSteps: 6,
    nextStep() { if(this.step < this.totalSteps) this.step++; window.scrollTo({top: 0, behavior: 'smooth'}); },
    prevStep() { if(this.step > 1) this.step--; window.scrollTo({top: 0, behavior: 'smooth'}); }
}" class="space-y-6">
    
    <!-- Wizard Progress Indicator (Non-clickable) -->
    <div class="card-premium mb-8 p-6 shadow-sm overflow-hidden relative">
        <div class="absolute top-0 left-0 h-1 bg-red-500 transition-all duration-500" :style="'width: ' + (step/totalSteps * 100) + '%'"></div>
        
        <div class="flex items-center justify-between relative z-10">
            <template x-for="i in totalSteps">
                <div class="flex flex-col items-center gap-2 flex-1 relative">
                    <!-- Connector Line -->
                    <div x-show="i < totalSteps" class="absolute top-5 left-[50%] w-full h-px bg-slate-100 -z-0"></div>
                    
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-xs transition-all border-2 z-10"
                         :class="step >= i ? 'bg-red-500 border-red-500 text-white shadow-lg shadow-red-100' : 'bg-white border-slate-100 text-slate-300'">
                        <span x-text="i"></span>
                    </div>
                    <span class="text-[9px] font-black uppercase tracking-widest text-center"
                          :class="step === i ? 'text-red-500' : 'text-slate-400'">
                        <template x-if="i === 1"><span>Identitas</span></template>
                        <template x-if="i === 2"><span>Observasi</span></template>
                        <template x-if="i === 3"><span>Diagnosa</span></template>
                        <template x-if="i === 4"><span>Skoring</span></template>
                        <template x-if="i === 5"><span>Saran</span></template>
                        <template x-if="i === 6"><span>Final</span></template>
                    </span>
                </div>
            </template>
        </div>
    </div>

    <form method="POST" action="{{ route('assessment.store') }}" enctype="multipart/form-data" id="assessmentForm">
        @csrf

        <div class="tab-content relative">
            <!-- Step 1: Data Umum -->
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
                                    <select class="form-control select2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 @error('anak_id') is-invalid @enderror" name="anak_id" id="nama_anak" required>
                                        <option value="">-- Pilih Anak --</option>
                                        @foreach ($anaks as $anak)
                                            <option value="{{ $anak->id }}" {{ old('anak_id') == $anak->id ? 'selected' : '' }}>
                                                {{ $anak->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('anak_id')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                <div>
                                    <label for="psikolog_id" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                        <i data-lucide="user" class="w-4 h-4 text-slate-400"></i> Psikolog Pemeriksa <span class="text-red-500">*</span>
                                    </label>
                                    @if(auth()->user()->hasRole('psikolog'))
                                        <input type="hidden" name="psikolog_id" value="{{ auth()->user()->id }}">
                                        <input type="text" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 text-slate-500 cursor-not-allowed" value="{{ auth()->user()->nama }}" readonly>
                                    @else
                                        <select class="form-control select2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 @error('psikolog_id') is-invalid @enderror" name="psikolog_id" required>
                                            <option value="">-- Pilih Psikolog --</option>
                                            @foreach ($psikologs as $psikolog)
                                                <option value="{{ $psikolog->id }}" {{ old('psikolog_id') == $psikolog->id ? 'selected' : '' }}>
                                                    {{ $psikolog->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('psikolog_id')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label for="tanggal_assessment" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                        <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i> Tanggal Pemeriksaan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 @error('tanggal_assessment') border-red-500 @enderror" name="tanggal_assessment" id="tanggal_assessment" value="{{ old('tanggal_assessment', date('Y-m-d')) }}" required>
                                    @error('tanggal_assessment')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                
                                <div>
                                    <p class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                        <i data-lucide="history" class="w-4 h-4 text-slate-400"></i> Riwayat Anamnesa (Wawancara)
                                    </p>
                                    <div id="wawancara-container" class="border border-slate-200 rounded-xl p-4 bg-slate-50 text-sm string text-slate-500 h-28 overflow-y-auto">
                                        <div class="text-center text-slate-400 flex flex-col items-center justify-center h-full">
                                            <i data-lucide="info" class="w-6 h-6 mb-2 text-slate-300"></i>
                                            Pilih nama anak terlebih dahulu.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="tujuan_pemeriksaan" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="bullseye" class="w-4 h-4 text-slate-400"></i> Tujuan Pemeriksaan <span class="text-red-500">*</span>
                            </label>
                            <textarea class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 form-control @error('tujuan_pemeriksaan') border-red-500 @enderror" id="tujuan_pemeriksaan" name="tujuan_pemeriksaan" rows="2" placeholder="Contoh: Evaluasi kesiapan sekolah, diagnosa awal..." required>{{ old('tujuan_pemeriksaan') }}</textarea>
                            @error('tujuan_pemeriksaan')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="clipboard-list" class="w-4 h-4 text-slate-400"></i> Sumber Asesmen <span class="text-red-500">*</span>
                            </label>
                            <div id="sumber-asesmen-container" class="space-y-3">
                                <div class="relative mb-3 flex items-center">
                                    <input type="text" class="form-control input-sumber-asesmen w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 pr-12" name="sumber_asesmen[]" placeholder="Contoh: Observasi Klinis" value="{{ old('sumber_asesmen.0', 'Wawancara dengan Orang Tua / Pengasuh') }}" required>
                                    <button class="btn-remove-sumber absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" disabled>
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" id="btn-tambah-sumber" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Sumber
                            </button>
                            <textarea class="hidden" id="sumber_asesmen_combined" name="sumber_asesmen_combined"></textarea>
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
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="activity" class="w-4 h-4 text-slate-400"></i> Perilaku yang Teramati <span class="text-red-500">*</span>
                            </label>
                            <div id="perilaku-container" class="space-y-3">
                                <div class="relative mb-3 flex items-center">
                                    <input type="text" class="form-control input-perilaku w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 pr-12" name="perilaku[]" placeholder="Contoh: Anak merespon panggilan dengan lambat..." value="{{ old('perilaku.0') }}" required>
                                    <button class="btn-remove absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" disabled>
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" id="btn-tambah-perilaku" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Temuan Perilaku
                            </button>
                            <p class="text-[10px] font-bold text-slate-400 mt-2 italic uppercase">Contoh: Penolakan kontak mata, cemas berlebih, kurang fokus, dll.</p>
                            <textarea class="hidden" id="perilaku_combined" name="perilaku_combined"></textarea>
                        </div>

                        <div>
                            <label for="kesimpulan_observasi" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="file-text" class="w-4 h-4 text-slate-400"></i> Ringkasan Kesimpulan Observasi <span class="text-red-500">*</span>
                            </label>
                            <textarea class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 @error('kesimpulan_observasi') border-red-500 @enderror" id="kesimpulan_observasi" name="kesimpulan_observasi" rows="4" placeholder="Tuliskan kesimpulan menyeluruh dari hasil pengamatan perilaku anak..." required>{{ old('kesimpulan_observasi') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Hasil & Diagnosa -->
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
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="clipboard-check" class="w-4 h-4 text-slate-400"></i> Temuan Medis / Psikologis <span class="text-red-500">*</span>
                            </label>
                            <div id="hasil-pemeriksaan-container" class="space-y-3">
                                <div class="relative mb-3 flex items-start">
                                    <textarea class="form-control input-hasil-pemeriksaan w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 pr-12" name="hasil_pemeriksaan[]" rows="2" placeholder="Tuliskan detail hasil pemeriksaan..." required>{{ old('hasil_pemeriksaan.0') }}</textarea>
                                    <button class="btn-remove-hasil absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" disabled>
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" id="btn-tambah-hasil" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Poin Analisis
                            </button>
                            <textarea class="hidden" id="hasil_pemeriksaan_combined" name="hasil_pemeriksaan_combined"></textarea>
                        </div>

                        <div>
                            <label for="diagnosa" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="activity" class="w-4 h-4 text-slate-400"></i> Diagnosis Akhir / Kesimpulan <span class="text-red-500">*</span>
                            </label>
                            <textarea class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 @error('diagnosa') border-red-500 @enderror" id="diagnosa" name="diagnosa" rows="4" placeholder="Tentukan diagnosis klinis berdasarkan hasil pemeriksaan..." required>{{ old('diagnosa') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: Skor & Alat Ukur -->
            <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="card-premium">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                        <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                            <i data-lucide="calculator" class="w-5 h-5"></i>
                        </div>
                        <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">IV. Skor Pengujian Alat Ukur</h5>
                    </div>
                    <div class="p-6 space-y-8">
                        <!-- Skor Overview Grid -->
                        <div class="grid grid-cols-2 lg:grid-cols-6 gap-4">
                            @foreach([['Kognitif', 'skor_kognitif'], ['Bahasa', 'skor_bahasa'], ['Motorik', 'skor_motorik'], ['Sos-Emosional', 'skor_sosial_emosional'], ['Adaptif', 'skor_perilaku_adaptif']] as $item)
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $item[0] }}</label>
                                <input type="number" name="{{ $item[1] }}" class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500" value="{{ old($item[1]) }}">
                            </div>
                            @endforeach
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-red-500 uppercase tracking-widest italic">IQ Total</label>
                                <input type="number" name="skor_iq_total" class="form-control w-full border-2 border-red-50 rounded-xl px-4 py-3 text-sm font-black text-red-600 focus:ring-2 focus:ring-red-100 focus:border-red-500 bg-red-50/30" value="{{ old('skor_iq_total') }}">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Klasifikasi IQ</label>
                                <textarea name="klasifikasi" rows="2" class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500" placeholder="Contoh: Rata-rata, Superior, dll">{{ old('klasifikasi') }}</textarea>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Interpretasi Skor</label>
                                <textarea name="interpretasi_skor" rows="2" class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500" placeholder="Detail interpretasi hasil tes...">{{ old('interpretasi_skor') }}</textarea>
                            </div>
                        </div>

                        <!-- Alat Ukur Table -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest">
                                    <i data-lucide="ruler" class="w-4 h-4 text-slate-400"></i> Detail Alat Ukur Psikologi
                                </label>
                                <button type="button" id="btn-tambah-alat" class="bg-slate-900 text-white hover:bg-black py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-slate-200">
                                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Baris
                                </button>
                            </div>

                            <div class="overflow-x-auto border border-slate-100 rounded-2xl bg-white shadow-sm">
                                <table class="w-full text-left" id="table-alat-ukur">
                                    <thead class="bg-slate-50 border-b border-slate-100">
                                        <tr>
                                            <th class="px-4 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Alat Ukur</th>
                                            <th class="px-4 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest w-24">Raw</th>
                                            <th class="px-4 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest w-24">Std</th>
                                            <th class="px-4 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest w-24">%tile</th>
                                            <th class="px-4 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Klasifikasi</th>
                                            <th class="px-4 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Catatan</th>
                                            <th class="px-4 py-3 text-center w-16"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50" id="alat-ukur-body">
                                        <tr class="alat-ukur-row group">
                                            <td class="px-2 py-3">
                                                <select name="alat_ukur[0][nama]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs font-bold focus:ring-0 appearance-none">
                                                    <option value="">-- Pilih Alat Ukur --</option>
                                                    @foreach($alatukurs as $tool)
                                                        <option value="{{ $tool->singkatan }}">{{ $tool->singkatan }} - {{ $tool->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-2 py-3">
                                                <input type="text" name="alat_ukur[0][skor_raw]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0">
                                            </td>
                                            <td class="px-2 py-3">
                                                <input type="text" name="alat_ukur[0][skor_standar]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0">
                                            </td>
                                            <td class="px-2 py-3">
                                                <input type="text" name="alat_ukur[0][persentil]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0">
                                            </td>
                                            <td class="px-2 py-3">
                                                <input type="text" name="alat_ukur[0][klasifikasi]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0">
                                            </td>
                                            <td class="px-2 py-3">
                                                <input type="text" name="alat_ukur[0][catatan]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0">
                                            </td>
                                            <td class="px-2 py-3 text-center">
                                                <button type="button" class="btn-remove-alat p-1.5 text-slate-300 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-all" disabled>
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 5: Rekomendasi -->
            <div x-show="step === 5" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="card-premium">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                        <div class="p-2 bg-pink-100 text-pink-600 rounded-lg">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </div>
                        <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">V. Rekomendasi Penanganan</h5>
                    </div>
                    <div class="p-6 space-y-8">
                        @foreach([['Pihak Keluarga', 'rekomendasi-orangtua-container', 'rekomendasi_orangtua[]'], ['Intervensi Terapi', 'rekomendasi-terapi-container', 'rekomendasi_terapi[]']] as $rec)
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="users" class="w-4 h-4 text-slate-400"></i> Rekomendasi untuk {{ $rec[0] }} <span class="text-red-500">*</span>
                            </label>
                            <div id="{{ $rec[1] }}" class="space-y-3">
                                <div class="relative mb-3 flex items-start">
                                    <textarea class="form-control input-rekomendasi w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 pr-12" name="{{ $rec[2] }}" rows="2" placeholder="Tuliskan saran konkret..." required>{{ old(str_replace('[]', '.0', $rec[2])) }}</textarea>
                                    <button class="btn-remove-rekomendasi absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" disabled>
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" id="btn-tambah-{{ strpos($rec[1], 'orangtua') !== false ? 'orangtua' : 'terapi' }}" class="mt-3 bg-slate-50 text-slate-600 hover:bg-slate-100 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors border border-slate-100">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Rekomendasi
                            </button>
                        </div>
                        @endforeach

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            @foreach([['Saran Rujukan', 'rujukan_container', 'saran_rujukan_combined'], ['Prioritas Terapi', 'prioritas_container', 'prioritas_terapi_combined']] as $ref)
                            <div>
                                <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                    <i data-lucide="plus-square" class="w-4 h-4 text-slate-400"></i> {{ $ref[0] }}
                                </label>
                                <div id="{{ $ref[1] }}" class="combined-input-container space-y-3">
                                    <div class="input-group mb-2 relative flex items-center">
                                        <input type="text" class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 pr-12" placeholder="...">
                                        <button class="remove-item absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white" type="button">
                                            <i data-lucide="x" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="mt-3 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 py-2 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-colors add-item" data-target="#{{ $ref[1] }}">
                                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Poin
                                </button>
                                <input type="hidden" name="{{ $ref[2] }}" id="{{ $ref[2] }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 6: Persetujuan -->
            <div x-show="step === 6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="card-premium">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                        <div class="p-2 bg-slate-900 text-white rounded-lg">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                        </div>
                        <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">VI. Finalisasi & Persetujuan Psikolog</h5>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white relative overflow-hidden">
                            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                                <div class="space-y-2 text-center md:text-left">
                                    <h4 class="text-lg font-black uppercase italic tracking-tight leading-none text-emerald-400">Persetujuan Dokumen</h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Apakah Anda menyetujui seluruh hasil assessment ini?</p>
                                </div>
                                <div class="flex gap-4">
                                    <label class="cursor-pointer group">
                                        <input type="radio" id="persetujuan_ya" name="persetujuan_psikolog" value="1" class="hidden peer" required>
                                        <div class="px-8 py-3 rounded-2xl border-2 border-white/10 bg-white/5 text-xs font-black uppercase peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all">Setuju</div>
                                    </label>
                                    <label class="cursor-pointer group">
                                        <input type="radio" id="persetujuan_tidak" name="persetujuan_psikolog" value="0" class="hidden peer">
                                        <div class="px-8 py-3 rounded-2xl border-2 border-white/10 bg-white/5 text-xs font-black uppercase peer-checked:bg-red-500 peer-checked:border-red-500 transition-all">Tinjau Lagi</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="alasan-tidak-setuju-group" style="display: none;" class="bg-red-50 border border-red-100 p-6 rounded-2xl animate-in fade-in slide-in-from-top-4 duration-300">
                            <label for="alasan_tidak_setuju" class="flex items-center gap-2 text-xs font-bold text-red-600 uppercase tracking-widest mb-2">
                                <i data-lucide="message-square" class="w-4 h-4"></i> Alasan Peninjauan Kembali <span class="text-red-500">*</span>
                            </label>
                            <textarea class="form-control w-full border border-red-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-200 focus:border-red-500 bg-white" id="alasan_tidak_setuju" name="alasan_tidak_setuju" rows="3" placeholder="Jelaskan alasan atau catatan tambahan untuk perbaikan..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wizard Navigation Footer -->
        <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
            <button type="button" 
                    x-show="step > 1" 
                    @click="prevStep()" 
                    class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 py-4 px-10 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center gap-2 transition-all shadow-sm">
                <i data-lucide="chevron-left" class="w-4 h-4"></i> Kembali
            </button>
            <div x-show="step === 1" class="flex-1"></div>

            <button type="button" 
                    x-show="step < totalSteps" 
                    @click="nextStep()" 
                    class="bg-red-500 hover:bg-red-600 text-white py-4 px-12 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center gap-2 transition-all shadow-lg shadow-red-200">
                Berikutnya <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </button>

            <button type="submit" 
                    x-show="step === totalSteps" 
                    class="bg-emerald-500 hover:bg-emerald-600 text-white py-4 px-16 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center gap-2 transition-all shadow-lg shadow-emerald-200">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Laporan
            </button>
        </div>
    </form>
</div>

<script>
    // Update progress bar & icons in Step Change
    document.addEventListener('alpine:init', () => {
        // Alpine logic already handled in x-data
    });
    
    // Watch step changes to re-init lucide icons
    window.addEventListener('scroll', () => {}); // placeholder
</script>
