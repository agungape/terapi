<form method="POST" action="{{ route('assessment.update', $assessment->id) }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PATCH')

    <!-- Multi-step form navigation -->
    <div class="card-premium mb-8 p-3 overflow-x-auto shadow-sm">
        <ul class="nav nav-pills flex items-center justify-between min-w-max gap-2 hidden-scroll border-none mb-0">
            <li class="nav-item flex-1 list-none">
                <a class="nav-link active bg-transparent border-none rounded-2xl text-center py-4 px-6 text-xs font-bold text-slate-500 hover:bg-slate-50 hover:text-amber-600 transition-all cursor-pointer flex flex-col items-center gap-2 group w-full" href="#data-umum" data-toggle="tab">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-amber-100 group-[.active]:bg-amber-500 group-[.active]:text-white transition-all shadow-sm step-icon mt-2">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <span class="uppercase tracking-widest mt-2 block">Data Umum</span>
                </a>
            </li>
            <li class="nav-item flex-1 list-none">
                <a class="nav-link bg-transparent border-none rounded-2xl text-center py-4 px-6 text-xs font-bold text-slate-500 hover:bg-slate-50 hover:text-amber-600 transition-all cursor-pointer flex flex-col items-center gap-2 group w-full" href="#observasi" data-toggle="tab">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-amber-100 group-[.active]:bg-amber-500 group-[.active]:text-white transition-all shadow-sm step-icon mt-2">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </div>
                    <span class="uppercase tracking-widest mt-2 block">Observasi</span>
                </a>
            </li>
            <li class="nav-item flex-1 list-none">
                <a class="nav-link bg-transparent border-none rounded-2xl text-center py-4 px-6 text-xs font-bold text-slate-500 hover:bg-slate-50 hover:text-amber-600 transition-all cursor-pointer flex flex-col items-center gap-2 group w-full" href="#hasil-diagnosa" data-toggle="tab">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-amber-100 group-[.active]:bg-amber-500 group-[.active]:text-white transition-all shadow-sm step-icon mt-2">
                        <i data-lucide="stethoscope" class="w-5 h-5"></i>
                    </div>
                    <span class="uppercase tracking-widest mt-2 block">Diagnosa</span>
                </a>
            </li>
            <li class="nav-item flex-1 list-none">
                <a class="nav-link bg-transparent border-none rounded-2xl text-center py-4 px-6 text-xs font-bold text-slate-500 hover:bg-slate-50 hover:text-amber-600 transition-all cursor-pointer flex flex-col items-center gap-2 group w-full" href="#rekomendasi" data-toggle="tab">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-amber-100 group-[.active]:bg-amber-500 group-[.active]:text-white transition-all shadow-sm step-icon mt-2">
                        <i data-lucide="activity" class="w-5 h-5"></i>
                    </div>
                    <span class="uppercase tracking-widest mt-2 block">Rekomendasi</span>
                </a>
            </li>
            <li class="nav-item flex-1 list-none">
                <a class="nav-link bg-transparent border-none rounded-2xl text-center py-4 px-6 text-xs font-bold text-slate-500 hover:bg-slate-50 hover:text-amber-600 transition-all cursor-pointer flex flex-col items-center gap-2 group w-full" href="#dokumen" data-toggle="tab">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-amber-100 group-[.active]:bg-amber-500 group-[.active]:text-white transition-all shadow-sm step-icon mt-2">
                        <i data-lucide="file-signature" class="w-5 h-5"></i>
                    </div>
                    <span class="uppercase tracking-widest mt-2 block">Persetujuan</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content relative">
        <!-- Tab 1: Data Umum -->
        <div class="tab-pane active" id="data-umum">
            <div class="card-premium">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                    <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                        <i data-lucide="user-circle" class="w-5 h-5"></i>
                    </div>
                    <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">Data Klien</h5>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="nama_anak" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                    <i data-lucide="child" class="w-4 h-4 text-slate-400"></i> Nama Anak <span class="text-amber-500">*</span>
                                </label>
                                <select class="form-control select2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 @error('anak_id') is-invalid @enderror" name="anak_id" id="nama_anak" required>
                                    <option value="">-- Pilih Anak --</option>
                                    @foreach ($anaks as $anak)
                                        <option value="{{ $anak->id }}" {{ old('anak_id', $assessment->anak_id) == $anak->id ? 'selected' : '' }}>
                                            {{ $anak->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('anak_id')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div>
                                <label for="psikolog_id" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                    <i data-lucide="user" class="w-4 h-4 text-slate-400"></i> Psikolog <span class="text-amber-500">*</span>
                                </label>
                                @if(auth()->user()->hasRole('psikolog'))
                                    <input type="hidden" name="psikolog_id" value="{{ $assessment->psikolog_id }}">
                                    <input type="text" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 text-slate-500 cursor-not-allowed" value="{{ $assessment->psikolog->nama }}" readonly>
                                @else
                                    <select class="form-control select2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 @error('psikolog_id') is-invalid @enderror" name="psikolog_id" required>
                                        <option value="">-- Pilih Psikolog --</option>
                                        @foreach ($psikologs as $psikolog)
                                            <option value="{{ $psikolog->id }}" {{ old('psikolog_id', $assessment->psikolog_id) == $psikolog->id ? 'selected' : '' }}>
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
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i> Tanggal Pemeriksaan <span class="text-amber-500">*</span>
                                </label>
                                <input type="date" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 @error('tanggal_assessment') border-red-500 @enderror" name="tanggal_assessment" id="tanggal_assessment" value="{{ old('tanggal_assessment', $assessment->tanggal_assessment->format('Y-m-d')) }}" required>
                                @error('tanggal_assessment')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            
                            <div>
                                <p class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                    <i data-lucide="history" class="w-4 h-4 text-slate-400"></i> Riwayat Anamnesa (Wawancara)
                                </p>
                                <div id="wawancara-container" class="border border-slate-200 rounded-xl p-4 bg-slate-50 text-sm string text-slate-500 h-28 overflow-y-auto">
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
                                <i data-lucide="target" class="w-4 h-4 text-slate-400"></i> Tujuan Pemeriksaan <span class="text-amber-500">*</span>
                            </label>
                            <textarea class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 form-control @error('tujuan_pemeriksaan') border-red-500 @enderror" id="tujuan_pemeriksaan" name="tujuan_pemeriksaan" rows="2" placeholder="Contoh: Evaluasi kesiapan sekolah, diagnosa awal..." required>{{ old('tujuan_pemeriksaan', $assessment->tujuan_pemeriksaan) }}</textarea>
                            @error('tujuan_pemeriksaan')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div>
                            <label for="keluhan_utama" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                                <i data-lucide="message-square" class="w-4 h-4 text-slate-400"></i> Keluhan Utama (Chief Complaint)
                            </label>
                            <textarea class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 form-control @error('keluhan_utama') border-red-500 @enderror" id="keluhan_utama" name="keluhan_utama" rows="2" placeholder="Tuliskan keluhan utama dari orang tua/pengasuh...">{{ old('keluhan_utama', $assessment->keluhan_utama) }}</textarea>
                            @error('keluhan_utama')<span class="text-xs text-red-500 mt-1 d-block"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                            <i data-lucide="clipboard-list" class="w-4 h-4 text-slate-400"></i> Sumber Asesmen <span class="text-amber-500">*</span>
                        </label>
                        <div id="sumber-asesmen-container" class="space-y-3">
                            @foreach ($assessment->sumber_asesmen as $index => $sumber)
                            <div class="relative mb-3 flex items-center">
                                <input type="text" class="form-control input-sumber-asesmen w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12" name="sumber_asesmen[]" placeholder="Contoh: Observasi Klinis" value="{{ old('sumber_asesmen.' . $index, $sumber) }}" required>
                                <button class="btn-remove-sumber absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" {{ count($assessment->sumber_asesmen) <= 1 ? 'disabled' : '' }}>
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="btn-tambah-sumber" class="mt-3 bg-amber-50 text-amber-600 hover:bg-amber-100 py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-2 transition-colors">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Sumber
                        </button>
                        <textarea class="hidden" id="sumber_asesmen_combined" name="sumber_asesmen_combined"></textarea>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-100">
                        <button type="button" class="bg-amber-500 hover:bg-amber-600 text-white py-3 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-amber-200 next-tab" data-next="observasi">
                            Lanjutkan <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2: Observasi -->
        <div class="tab-pane" id="observasi">
            <div class="card-premium">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                    <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </div>
                    <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">Hasil Observasi Awal</h5>
                </div>
                <div class="p-6 space-y-8">
                    <!-- Observasi Status Klinis -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <i data-lucide="brain" class="w-4 h-4 text-emerald-500"></i> Observasi Status Klinis
                        </h6>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach([
                                ['mood_anak', 'smile', 'Mood Anak', 'Ceria, kooperatif, sedih, dll'],
                                ['validitas_hasil', 'check-square', 'Validitas Hasil', 'Valid, cukup valid, kurang valid'],
                                ['catatan_rapport', 'users', 'Catatan Rapport', 'Terjalin baik, butuh waktu, dll'],
                                ['kontak_mata', 'eye', 'Kontak Mata', 'Adekuat, terbatas, tidak ada'],
                                ['komunikasi', 'message-circle', 'Komunikasi', 'Verbal, non-verbal, minim'],
                                ['interaksi_sosial', 'handshake', 'Interaksi Sosial', 'Aktif, pasif, menarik diri']
                            ] as $field)
                            <div>
                                <label for="{{ $field[0] }}" class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                                    <i data-lucide="{{ $field[1] }}" class="w-3.5 h-3.5 text-slate-400"></i> {{ $field[2] }}
                                </label>
                                <input type="text" name="{{ $field[0] }}" id="{{ $field[0] }}" 
                                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 @error($field[0]) border-red-500 @enderror" 
                                       placeholder="{{ $field[3] }}" value="{{ old($field[0], $assessment->{$field[0]}) }}">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                            <i data-lucide="activity" class="w-4 h-4 text-slate-400"></i> Observasi Awal Anak <span class="text-amber-500">*</span>
                        </label>
                        <div id="perilaku-container" class="space-y-3">
                            @foreach ($assessment->observasi_awal as $index => $perilaku)
                            <div class="relative mb-3 flex items-center">
                                <input type="text" class="form-control input-perilaku w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12" name="perilaku[]" placeholder="Contoh: Anak merespon panggilan dengan lambat..." value="{{ old('perilaku.' . $index, $perilaku) }}" required>
                                <button class="btn-remove absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" {{ count($assessment->observasi_awal) <= 1 ? 'disabled' : '' }}>
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="btn-tambah-perilaku" class="mt-3 bg-amber-50 text-amber-600 hover:bg-amber-100 py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-2 transition-colors">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Perilaku
                        </button>
                        <p class="text-xs text-slate-400 mt-2">Contoh: Penolakan, cemas, kurang fokus, menghindar saat diberikan tugas, dll.</p>
                        <textarea class="hidden" id="perilaku_combined" name="perilaku_combined"></textarea>
                    </div>

                    <div>
                        <label for="kesimpulan_observasi" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                            <i data-lucide="file-text" class="w-4 h-4 text-slate-400"></i> Kesimpulan Observasi Awal <span class="text-amber-500">*</span>
                        </label>
                        <textarea class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 @error('kesimpulan_observasi') border-red-500 @enderror" id="kesimpulan_observasi" name="kesimpulan_observasi" rows="4" required>{{ old('kesimpulan_observasi', $assessment->kesimpulan_observasi) }}</textarea>
                    </div>

                    <div class="flex justify-between pt-4 border-t border-slate-100">
                        <button type="button" class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 py-3 px-6 rounded-xl text-xs font-bold flex items-center gap-2 transition-all shadow-sm prev-tab" data-prev="data-umum">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                        </button>
                        <button type="button" class="bg-amber-500 hover:bg-amber-600 text-white py-3 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-amber-200 next-tab" data-next="hasil-diagnosa">
                            Lanjutkan <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 3: Hasil & Diagnosa -->
        <div class="tab-pane" id="hasil-diagnosa">
            <div class="card-premium">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                    <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                        <i data-lucide="stethoscope" class="w-5 h-5"></i>
                    </div>
                    <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">Hasil Pemeriksaan & Diagnosa</h5>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                            <i data-lucide="clipboard-check" class="w-4 h-4 text-slate-400"></i> Hasil Pemeriksaan Lengkap <span class="text-amber-500">*</span>
                        </label>
                        <div id="hasil-pemeriksaan-container" class="space-y-3">
                            @foreach ($assessment->hasil_pemeriksaan as $index => $hasil)
                            <div class="relative mb-3 flex items-start">
                                <textarea class="form-control input-hasil-pemeriksaan w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12" name="hasil_pemeriksaan[]" rows="2" placeholder="Tuliskan detail hasil pemeriksaan..." required>{{ old('hasil_pemeriksaan.' . $index, $hasil) }}</textarea>
                                <button class="btn-remove-hasil absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" {{ count($assessment->hasil_pemeriksaan) <= 1 ? 'disabled' : '' }}>
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="btn-tambah-hasil" class="mt-3 bg-amber-50 text-amber-600 hover:bg-amber-100 py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-2 transition-colors">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Hasil Temuan
                        </button>
                        <textarea class="hidden" id="hasil_pemeriksaan_combined" name="hasil_pemeriksaan_combined"></textarea>
                    </div>

                    <div>
                        <label for="diagnosa" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                            <i data-lucide="activity" class="w-4 h-4 text-slate-400"></i> Diagnosa Awal / Kesimpulan <span class="text-amber-500">*</span>
                        </label>
                        <textarea class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 @error('diagnosa') border-red-500 @enderror" id="diagnosa" name="diagnosa" rows="4" required>{{ old('diagnosa', $assessment->diagnosa) }}</textarea>
                    </div>

                    <div class="flex justify-between pt-4 border-t border-slate-100">
                        <button type="button" class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 py-3 px-6 rounded-xl text-xs font-bold flex items-center gap-2 transition-all shadow-sm prev-tab" data-prev="observasi">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                        </button>
                        <button type="button" class="bg-amber-500 hover:bg-amber-600 text-white py-3 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-amber-200 next-tab" data-next="rekomendasi">
                            Lanjutkan <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 4: Rekomendasi -->
        <div class="tab-pane" id="rekomendasi">
            <div class="card-premium">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                    <div class="p-2 bg-pink-100 text-pink-600 rounded-lg">
                        <i data-lucide="heart" class="w-5 h-5"></i>
                    </div>
                    <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">Rekomendasi Penanganan</h5>
                </div>
                <div class="p-6 space-y-8">
                    <div>
                        <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                            <i data-lucide="users" class="w-4 h-4 text-slate-400"></i> Rekomendasi untuk Orang Tua/Keluarga <span class="text-amber-500">*</span>
                        </label>
                        <div id="rekomendasi-orangtua-container" class="space-y-3">
                            @foreach ($assessment->rekomendasi_orangtua as $index => $rekomendasi)
                            <div class="relative mb-3 flex items-start">
                                <textarea class="form-control input-rekomendasi w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12" name="rekomendasi_orangtua[]" rows="2" placeholder="Contoh: Bangun rutinitas yang tetap..." required>{{ old('rekomendasi_orangtua.' . $index, $rekomendasi) }}</textarea>
                                <button class="btn-remove-rekomendasi absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" {{ count($assessment->rekomendasi_orangtua) <= 1 ? 'disabled' : '' }}>
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="btn-tambah-orangtua" class="mt-3 bg-amber-50 text-amber-600 hover:bg-amber-100 py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-2 transition-colors">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Rekomendasi
                        </button>
                        <textarea class="hidden" id="rekomendasi_orangtua_combined" name="rekomendasi_orangtua_combined"></textarea>
                    </div>

                    <div>
                        <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                            <i data-lucide="activity" class="w-4 h-4 text-slate-400"></i> Rekomendasi Terapi/Intervensi <span class="text-amber-500">*</span>
                        </label>
                        <div id="rekomendasi-terapi-container" class="space-y-3">
                            @foreach ($assessment->rekomendasi_terapi as $index => $rekomendasi)
                            <div class="relative mb-3 flex items-start">
                                <textarea class="form-control input-rekomendasi w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12" name="rekomendasi_terapi[]" rows="2" placeholder="Contoh: Terapi Wicara 2x Seminggu..." required>{{ old('rekomendasi_terapi.' . $index, $rekomendasi) }}</textarea>
                                <button class="btn-remove-rekomendasi absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button" {{ count($assessment->rekomendasi_terapi) <= 1 ? 'disabled' : '' }}>
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="btn-tambah-terapi" class="mt-3 bg-amber-50 text-amber-600 hover:bg-amber-100 py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-2 transition-colors">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Rekomendasi
                        </button>
                        <textarea class="hidden" id="rekomendasi_terapi_combined" name="rekomendasi_terapi_combined"></textarea>
                    </div>



                    <div>
                        <label for="catatan_tambahan" class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">
                            <i data-lucide="bookmark" class="w-4 h-4 text-slate-400"></i> Catatan Tambahan
                        </label>
                        <textarea class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500" id="catatan_tambahan" name="catatan_tambahan" rows="3" placeholder="Tambahkan catatan lain yang diperlukan...">{{ old('catatan_tambahan', $assessment->catatan_tambahan) }}</textarea>
                    </div>

                    <div class="flex justify-between pt-4 border-t border-slate-100">
                        <button type="button" class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 py-3 px-6 rounded-xl text-xs font-bold flex items-center gap-2 transition-all shadow-sm prev-tab" data-prev="hasil-diagnosa">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                        </button>
                        <button type="button" class="bg-amber-500 hover:bg-amber-600 text-white py-3 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-amber-200 next-tab" data-next="dokumen">
                            Lanjutkan <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 5: Persetujuan Psikolog -->
        <div class="tab-pane" id="dokumen">
            <div class="card-premium">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3 rounded-t-2xl">
                    <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                    </div>
                    <h5 class="text-sm font-extrabold text-slate-700 m-0 tracking-tight">Persetujuan Penandatanganan</h5>
                </div>
                <div class="p-6 space-y-6">
                    <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl">
                        <label class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-widest mb-4">
                            <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500"></i> Apakah Anda Menyetujui Dokumen Assessment Ini? <span class="text-amber-500">*</span>
                        </label>
                        <div class="flex flex-col sm:flex-row gap-4 mb-2">
                            <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-amber-500 transition-colors flex-1">
                                <input type="radio" id="persetujuan_ya" name="persetujuan_psikolog" class="w-5 h-5 text-amber-500 focus:ring-amber-500" value="1" {{ old('persetujuan_psikolog', $assessment->persetujuan_psikolog) ? 'checked' : '' }} required>
                                <span class="text-sm font-bold text-slate-700">Ya, Saya Setuju</span>
                            </label>
                            <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-slate-400 transition-colors flex-1">
                                <input type="radio" id="persetujuan_tidak" name="persetujuan_psikolog" class="w-5 h-5 text-slate-400 focus:ring-slate-400" value="0" {{ !old('persetujuan_psikolog', $assessment->persetujuan_psikolog) ? 'checked' : '' }}>
                                <span class="text-sm font-bold text-slate-700">Tidak, Saya Tidak Setuju</span>
                            </label>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">Dengan memilih "Ya", Anda menyetujui seluruh hasil assessment dan rekomendasi yang diberikan dan dokumen akan ditandatangani.</p>
                    </div>

                    <div id="alasan-tidak-setuju-group" style="{{ !old('persetujuan_psikolog', $assessment->persetujuan_psikolog) ? '' : 'display: none;' }}" class="bg-red-50 border border-red-100 p-6 rounded-2xl overflow-hidden animate-in fade-in slide-in-from-top-4 duration-300">
                        <label for="alasan_tidak_setuju" class="flex items-center gap-2 text-xs font-bold text-red-600 uppercase tracking-widest mb-2">
                            <i data-lucide="message-square" class="w-4 h-4 text-red-500"></i> Alasan Tidak Menyetujui <span class="text-red-500">*</span>
                        </label>
                        <textarea class="form-control w-full border border-red-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-200 focus:border-red-500 bg-white" id="alasan_tidak_setuju" name="alasan_tidak_setuju" rows="3" placeholder="Jelaskan alasan Anda tidak menyetujui dokumen assessment ini...">{{ old('alasan_tidak_setuju', $assessment->alasan_tidak_setuju) }}</textarea>
                    </div>

                    <div class="flex justify-between pt-4 border-t border-slate-100">
                        <button type="button" class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 py-3 px-6 rounded-xl text-xs font-bold flex items-center gap-2 transition-all shadow-sm prev-tab" data-prev="rekomendasi">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                        </button>
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white py-3 px-8 rounded-xl text-sm font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-emerald-200">
                            <i data-lucide="save" class="w-5 h-5"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
