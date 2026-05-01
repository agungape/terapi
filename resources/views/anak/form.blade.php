@csrf
<div class="space-y-10 animate-in fade-in duration-700" x-data="{ step: 1 }">
    
    @if ($errors->any())
    <div class="card-premium p-6 bg-red-50 border-red-100 animate-bounce">
        <div class="flex items-center gap-4 text-red-600">
            <div class="p-3 bg-white rounded-2xl shadow-sm">
                <i data-lucide="alert-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest">Pendaftaran Gagal</h4>
                <p class="text-[10px] font-bold opacity-80 mt-1">Mohon periksa kembali field yang berwarna merah di bawah ini.</p>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Premium Stepper -->
    <div class="card-premium p-8 bg-white border-none shadow-xl shadow-slate-200/50">
        <div class="flex items-center justify-between max-w-2xl mx-auto relative mb-2">
            <!-- Connector Line -->
            <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-100 -translate-y-1/2 -z-0"></div>
            <div class="absolute top-1/2 left-0 h-0.5 bg-red-500 -translate-y-1/2 transition-all duration-500 -z-0" 
                 :style="'width: ' + ((step - 1) * 100) + '%'"></div>

            <!-- Step 1 -->
            <button type="button" @click="step = 1" class="relative z-10 flex flex-col items-center group">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-300 shadow-lg"
                     :class="step >= 1 ? 'bg-red-500 text-white shadow-red-200' : 'bg-white text-slate-400 border border-slate-200'">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </div>
                <span class="mt-3 text-[10px] font-black uppercase tracking-widest transition-colors duration-300"
                      :class="step >= 1 ? 'text-slate-800' : 'text-slate-400'">Data Anak</span>
            </button>

            <!-- Step 2 -->
            <button type="button" @click="step = 2" class="relative z-10 flex flex-col items-center group">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-300 shadow-lg"
                     :class="step >= 2 ? 'bg-red-500 text-white shadow-red-200' : 'bg-white text-slate-400 border border-slate-200'">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <span class="mt-3 text-[10px] font-black uppercase tracking-widest transition-colors duration-300"
                      :class="step >= 2 ? 'text-slate-800' : 'text-slate-400'">Data Orang Tua</span>
            </button>
        </div>
    </div>

    <!-- Step 1: Data Anak -->
    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Photo Upload Card -->
            <div class="lg:col-span-4 space-y-6">
                <div class="card-premium p-8 bg-white flex flex-col items-center text-center">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Profil Pasien</h4>
                    
                    <div class="relative group cursor-pointer" onclick="document.getElementById('photoInput').click()">
                        <div class="w-40 h-40 rounded-[2.5rem] bg-slate-50 border-4 border-white shadow-2xl overflow-hidden transition-transform group-hover:scale-105 duration-300">
                            <img id="previewImage" 
                                 src="{{ asset($anak->foto ? 'storage/anak/' . $anak->foto : 'assets/images/faces/face1.jpg') }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute inset-0 bg-slate-900/40 rounded-[2.5rem] opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <i data-lucide="camera" class="text-white w-8 h-8"></i>
                        </div>
                    </div>

                    <input type="file" name="foto" id="photoInput" class="hidden" accept="image/*" onchange="previewFile(this)">
                    
                    <p class="mt-6 text-[11px] font-bold text-slate-500 leading-relaxed uppercase tracking-tighter">
                        Unggah foto terbaru untuk mempermudah <br>identifikasi pasien di klinik.
                    </p>

                    @if ($anak->id && $anak->foto)
                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('delete.foto', $anak->id) }}" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all border border-red-100">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </a>
                    </div>
                    @endif
                </div>

                <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden group">
                    <i data-lucide="shield-check" class="w-24 h-24 absolute -right-4 -bottom-4 text-white/5"></i>
                    <h5 class="text-xs font-black uppercase tracking-widest mb-2">Keamanan Data</h5>
                    <p class="text-[10px] text-slate-400 italic font-bold">Seluruh informasi medis dan biodata anak dilindungi sesuai dengan kebijakan privasi Bright Star.</p>
                </div>
            </div>

            <!-- Bio Data Form -->
            <div class="lg:col-span-8 card-premium p-8 md:p-10 bg-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Global NID (hidden) -->
                    <input type="hidden" name="nib" value="{{ old('nib') ?? ($anak->nib ?? '') }}">

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap Anak</label>
                        <input type="text" name="nama" value="{{ old('nama') ?? ($anak->nama ?? '') }}" required placeholder="Nama sesuai akta..."
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-black text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none italic placeholder:text-slate-300">
                        @error('nama') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Jenis Kelamin</label>
                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer group">
                                <input type="radio" name="jenis_kelamin" value="L" class="hidden peer" {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                <div class="px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-black uppercase tracking-widest text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center @error('jenis_kelamin') border-red-300 bg-red-50 @enderror">Laki-Laki</div>
                            </label>
                            <label class="flex-1 cursor-pointer group">
                                <input type="radio" name="jenis_kelamin" value="P" class="hidden peer" {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                <div class="px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-black uppercase tracking-widest text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center @error('jenis_kelamin') border-red-300 bg-red-50 @enderror">Perempuan</div>
                            </label>
                        </div>
                        @error('jenis_kelamin') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') ?? ($anak->tempat_lahir ?? '') }}" placeholder="Kota kelahiran..."
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none @error('tempat_lahir') border-red-300 bg-red-50 @enderror">
                        @error('tempat_lahir') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') ?? ($anak->tanggal_lahir ?? '') }}"
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-black text-red-600 focus:ring-4 focus:ring-red-50 transition-all outline-none @error('tanggal_lahir') border-red-300 bg-red-50 @enderror">
                        @error('tanggal_lahir') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pendidikan Saat Ini</label>
                        <select name="pendidikan" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 outline-none focus:ring-4 focus:ring-red-50 transition-all appearance-none @error('pendidikan') border-red-300 bg-red-50 @enderror">
                            @foreach ($pendidikan as $value => $label)
                                <option value="{{ $value }}" {{ $value == old('pendidikan', $anak->pendidikan) ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('pendidikan') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Diagnosa Medis (Opsional)</label>
                        <input type="text" name="diagnosa" value="{{ old('diagnosa') ?? ($anak->diagnosa ?? '') }}" placeholder="Masukkan keterangan diagnosa jika ada..."
                               class="w-full bg-red-50/30 border-red-50 rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none italic">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat Domisili</label>
                        <textarea name="alamat" rows="3" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none placeholder:italic @error('alamat') border-red-300 bg-red-50 @enderror" placeholder="Jl. Alamat lengkap nomor rumah, RT/RW, dsb...">{{ old('alamat') ?? ($anak->alamat ?? '') }}</textarea>
                        @error('alamat') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Anak Ke-</label>
                        <div class="flex items-center gap-4">
                            <input type="number" name="anak_ke" value="{{ old('anak_ke') ?? ($anak->anak_ke ?? '') }}" class="w-20 bg-slate-50 border-slate-100 rounded-xl px-4 py-3 text-sm font-black text-center focus:ring-4 focus:ring-red-50 outline-none">
                            <span class="text-[10px] font-black text-slate-300 uppercase">Dari</span>
                            <input type="text" name="total_saudara" value="{{ old('total_saudara') ?? ($anak->total_saudara ?? '') }}" class="w-20 bg-slate-50 border-slate-100 rounded-xl px-4 py-3 text-sm font-black text-center focus:ring-4 focus:ring-red-50 outline-none">
                            <span class="text-[10px] font-black text-slate-300 uppercase">Bersaudara</span>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex justify-end">
                    <button type="button" @click="step = 2" class="bg-red-500 hover:bg-red-600 text-white py-4 px-12 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center gap-2 shadow-lg shadow-red-100 transition-all">
                        Selanjutnya: Data Keluarga <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2: Data Orang Tua -->
    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Data Ibu -->
            <div class="card-premium p-8 md:p-10 bg-white border-t-4 border-t-red-500">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-2.5 bg-red-50 rounded-xl text-red-500"><i data-lucide="heart" class="w-5 h-5"></i></div>
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Informasi Ibu</h3>
                </div>
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu') ?? ($anak->nama_ibu ?? '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 outline-none transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">No. Telepon</label>
                            <input type="text" name="telepon_ibu" value="{{ old('telepon_ibu') ?? ($anak->telepon_ibu ?? '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Usia Sekarang</label>
                            <input type="text" name="umur_ibu" value="{{ old('umur_ibu') ?? ($anak->umur_ibu ?? '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 outline-none" placeholder="XX Tahun">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pendidikan</label>
                            <select name="pendidikan_ibu" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold outline-none appearance-none">
                                @foreach ($pendidikan_orangtua as $value => $label)
                                    <option value="{{ $value }}" {{ $value == old('pendidikan_ibu', $anak->pendidikan_ibu) ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Agama</label>
                            <select name="agama_ibu" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold outline-none appearance-none">
                                @foreach ($agama as $value => $label)
                                    <option value="{{ $value }}" {{ $value == old('agama_ibu', $anak->agama_ibu) ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pekerjaan</label>
                        <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') ?? ($anak->pekerjaan_ibu ?? '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none">
                    </div>
                </div>
            </div>

            <!-- Data Ayah -->
            <div class="card-premium p-8 md:p-10 bg-white border-t-4 border-t-blue-500">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-2.5 bg-blue-50 rounded-xl text-blue-500"><i data-lucide="user-plus" class="w-5 h-5"></i></div>
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Informasi Ayah</h3>
                </div>
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap Ayah</label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah') ?? ($anak->nama_ayah ?? '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 outline-none transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">No. Telepon</label>
                            <input type="text" name="telepon_ayah" value="{{ old('telepon_ayah') ?? ($anak->telepon_ayah ?? '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Usia Sekarang</label>
                            <input type="text" name="umur_ayah" value="{{ old('umur_ayah') ?? ($anak->umur_ayah ?? '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 outline-none" placeholder="XX Tahun">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pendidikan</label>
                            <span class="relative block">
                                <select name="pendidikan_ayah" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold outline-none appearance-none">
                                    @foreach ($pendidikan_orangtua as $value => $label)
                                        <option value="{{ $value }}" {{ $value == old('pendidikan_ayah', $anak->pendidikan_ayah) ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </span>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Agama</label>
                            <select name="agama_ayah" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold outline-none appearance-none">
                                @foreach ($agama as $value => $label)
                                    <option value="{{ $value }}" {{ $value == old('agama_ayah', $anak->agama_ayah) ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pekerjaan</label>
                        <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') ?? ($anak->pekerjaan_ayah ?? '') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none">
                    </div>
                </div>
            </div>

            <!-- Additional Detail Footer -->
            <div class="md:col-span-2 card-premium p-8 bg-slate-50 border-none">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="flex-1 space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Suku / Ras Keluarga</label>
                                <input type="text" name="suku_ibu" value="{{ old('suku_ibu') ?? ($anak->suku_ibu ?? '') }}" placeholder="Suku Ibu..." class="w-full bg-white border-slate-200 rounded-xl px-5 py-3 text-xs font-bold">
                            </div>
                            <div class="flex-1 space-y-2 mt-6">
                                <input type="text" name="suku_ayah" value="{{ old('suku_ayah') ?? ($anak->suku_ayah ?? '') }}" placeholder="Suku Ayah..." class="w-full bg-white border-slate-200 rounded-xl px-5 py-3 text-xs font-bold">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pernikahan Ke-</label>
                            <div class="flex items-center gap-4">
                                <input type="number" name="pernikahan_ibu" value="{{ old('pernikahan_ibu') ?? ($anak->pernikahan_ibu ?? '') }}" class="w-24 bg-white border-slate-200 rounded-xl px-4 py-3 text-xs font-bold text-center">
                                <span class="text-[10px] font-black text-slate-300 uppercase">Ibu & Pelayanan</span>
                                <input type="number" name="pernikahan_ayah" value="{{ old('pernikahan_ayah') ?? ($anak->pernikahan_ayah ?? '') }}" class="w-24 bg-white border-slate-200 rounded-xl px-4 py-3 text-xs font-bold text-center">
                                <span class="text-[10px] font-black text-slate-300 uppercase">Ayah</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Usia Orang Tua saat Ibu Hamil</label>
                            <div class="flex items-center gap-4">
                                <input type="text" name="usia_saat_hamil_ibu" value="{{ old('usia_saat_hamil_ibu') ?? ($anak->usia_saat_hamil_ibu ?? '') }}" placeholder="Usia Ibu..." class="flex-1 bg-white border-slate-200 rounded-xl px-5 py-3 text-xs font-bold">
                                <input type="text" name="usia_saat_hamil_ayah" value="{{ old('usia_saat_hamil_ayah') ?? ($anak->usia_saat_hamil_ayah ?? '') }}" placeholder="Usia Ayah..." class="flex-1 bg-white border-slate-200 rounded-xl px-5 py-3 text-xs font-bold">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @isset($terapi)
                <input type="hidden" name="url_asal" value="{{ old('url_asal') ?? (url()->previous() . '#row-' . $terapi->id) }}">
            @else
                <input type="hidden" name="url_asal" value="{{ old('url_asal') ?? url()->previous() }}">
            @endisset

            <div class="md:col-span-2 flex justify-between items-center py-8">
                <button type="button" @click="step = 1" class="text-slate-400 hover:text-red-500 text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Data Anak
                </button>
                <div class="flex gap-4">
                    <a href="{{ route('anak.index') }}" class="bg-white border border-slate-200 text-slate-500 py-4 px-10 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batalkan</a>
                    <button type="submit" class="bg-slate-900 hover:bg-black text-white py-4 px-14 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl transition-all">
                        {{ $tombol }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewFile(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
