@csrf

<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Premium Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('terapis.index') }}" class="hover:text-red-500 transition-colors">Data Terapis</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Registrasi Kompetensi</span>
        </div>
    </div>

    <!-- Hidden Fields -->
    <input type="hidden" name="nib" value="{{ old('nib') ?? ($terapi->nib ?? '') }}">
    <input type="hidden" name="status" value="{{ old('status') ?? ($terapi->status ?? '') }}">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Info Panel -->
        <div class="lg:col-span-4 space-y-6">
            <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden group">
                <div class="relative z-10 flex flex-col gap-4">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-red-500 transform group-hover:rotate-12 transition-transform">
                        <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-xs font-black uppercase tracking-widest">Registrasi Terpusat</h4>
                        <p class="text-[10px] text-slate-400 font-bold leading-relaxed">Pastikan data pendidikan dan kompetensi diisi dengan benar untuk keperluan audit layanan medik.</p>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 text-white/5"><i data-lucide="graduation-cap" class="w-24 h-24"></i></div>
            </div>

            <div class="card-premium p-8 bg-white border border-slate-100 flex items-center gap-4">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                </div>
                <div>
                    <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Status Akun</h5>
                    <p class="text-xs font-bold text-slate-700 mt-1 uppercase">Aktif System</p>
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="lg:col-span-8 card-premium p-8 md:p-10 bg-white shadow-xl shadow-slate-200/50 border-none">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Nama -->
                <div class="md:col-span-2 space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap & Gelar</label>
                    <input type="text" name="nama" value="{{ old('nama') ?? ($terapi->nama ?? '') }}" required placeholder="Contoh: dr. Name Surname, M.Psi..."
                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-black text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none italic placeholder:text-slate-300">
                    @error('nama') <p class="text-[10px] text-red-500 font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                </div>

                <!-- Kontak -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nomor HP / WhatsApp</label>
                    <div class="relative">
                        <i data-lucide="phone" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300"></i>
                        <input type="text" name="telepon" value="{{ old('telepon') ?? ($terapi->telepon ?? '') }}" placeholder="08xx-xxxx-xxxx"
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl pl-12 pr-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none">
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Lahir</label>
                    <div class="relative">
                        <i data-lucide="calendar" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300"></i>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') ?? ($terapi->tanggal_lahir ?? '') }}"
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl pl-12 pr-6 py-4 text-sm font-black text-red-600 focus:ring-4 focus:ring-red-50 transition-all outline-none">
                    </div>
                </div>

                <!-- Pendidikan -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Almamater / Kampus</label>
                    <input type="text" name="perguruan_tinggi" value="{{ old('perguruan_tinggi') ?? ($terapi->perguruan_tinggi ?? '') }}" placeholder="Nama Universitas..."
                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Program Studi / Jurusan</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan') ?? ($terapi->jurusan ?? '') }}" placeholder="Psikologi / Okupasi Terapi..."
                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none">
                </div>

                <!-- Role -->
                <div class="md:col-span-2 space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Jabatan / Role Klinik</label>
                    <select name="role" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-black text-slate-800 appearance-none focus:ring-4 focus:ring-red-50 transition-all outline-none">
                        @foreach ($role as $value => $label)
                            <option value="{{ $value }}" {{ $value == old('role', $terapi->role) ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2 space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat Domisili Sekarang</label>
                    <textarea name="alamat" rows="3" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none placeholder:italic" placeholder="Jl. Lengkap sesuai KTP/Domisili...">{{ old('alamat') ?? ($terapi->alamat ?? '') }}</textarea>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="mt-12 flex items-center justify-between border-t border-slate-50 pt-8">
                <a href="{{ route('terapis.index') }}" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-red-500 transition-colors flex items-center gap-2">
                    <i data-lucide="x" class="w-4 h-4"></i> Batalkan & Kembali
                </a>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-4 px-12 rounded-2xl text-xs font-black uppercase tracking-widest shadow-lg shadow-red-100 transition-all flex items-center gap-2">
                    {{ $tombol }} <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
