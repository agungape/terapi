@extends('layouts.master')
@section('title', 'Pendaftaran Kunjungan')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar / Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Pendaftaran Kunjungan</span>
        </div>
        
        <div class="flex items-center gap-3">
             <div class="hidden md:flex items-center gap-2 text-[11px] font-bold text-slate-500 bg-white px-3 py-1.5 rounded-xl border border-slate-100 shadow-sm">
                <i data-lucide="calendar" class="w-3.5 h-3.5 text-red-500"></i>
                <span>{{ now()->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Search Box -->
        <div class="lg:col-span-5">
            <div class="card-premium p-8 relative overflow-hidden">
                <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-red-50/50 rounded-full -z-0"></div>
                
                <div class="relative z-10 space-y-6">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="p-3 bg-red-50 text-red-600 rounded-2xl shadow-sm border border-red-100">
                            <i data-lucide="search" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-800 tracking-tight">Cari Pasien</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Input Nama atau NIB Anak</p>
                        </div>
                    </div>

                    <form action="{{ url('/pencarian/proses') }}" method="GET" class="relative">
                        @csrf
                        <input type="text" name="s" id="s" value="{{ $s ?? '' }}" autofocus
                               placeholder="Contoh: Budi Sudarsono..."
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold placeholder:text-slate-300 focus:ring-4 focus:ring-red-50 focus:bg-white focus:border-red-200 transition-all outline-none">
                        <button type="submit" class="absolute right-2 top-2 bottom-2 px-6 bg-red-500 hover:bg-red-600 text-white rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-red-100">
                            Cari
                        </button>
                    </form>
                    
                    <p class="text-[10px] font-bold text-slate-400 text-center italic">Tekan 'Enter' untuk memulai pencarian cepat</p>
                </div>
            </div>
        </div>

        <!-- Search Results List -->
        <div class="lg:col-span-7">
            <div class="card-premium h-full min-h-[300px] flex flex-col">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="list-checks" class="w-4 h-4 text-red-500"></i> HASIL PENCARIAN
                    </h3>
                    <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">{{ isset($result) ? count($result) : 0 }}</span>
                </div>
                
                <div class="flex-1 overflow-y-auto max-h-[400px] scrollbar-hide">
                    @isset($result)
                        @forelse($result as $anak)
                        <div class="p-5 border-b border-slate-50 hover:bg-slate-50/50 transition-colors group">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-red-600 font-extrabold text-sm shadow-sm">
                                        {{ strtoupper(substr($anak->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-extrabold text-slate-800 group-hover:text-red-600 transition-colors">{{ $anak->nama }}</h4>
                                        <div class="flex items-center gap-3 mt-0.5">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">NIB: {{ $anak->nib }}</span>
                                            <span class="text-slate-300">|</span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                @if ($anak->status == 'aktif')
                                    <button data-id="{{ $anak->id }}" data-nama="{{ $anak->nama }}" 
                                            class="bg-white border border-slate-200 hover:border-red-500 hover:text-red-600 text-slate-500 py-2 px-5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm kirim-data flex items-center gap-2">
                                        Pilih Pasien <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                    </button>
                                @else
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase italic border border-red-100">Nonaktif</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="h-full flex flex-col items-center justify-center p-12 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center mb-4 border border-slate-100">
                                <i data-lucide="search-x" class="w-8 h-8 text-slate-200"></i>
                            </div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-loose">Data tidak ditemukan.<br>Silakan masukkan kata kunci lain.</p>
                        </div>
                        @endforelse
                    @else
                    <div class="h-full flex flex-col items-center justify-center p-12 text-center opacity-50">
                        <div class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center mb-4">
                            <i data-lucide="user-plus" class="w-8 h-8 text-slate-200"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Silakan cari pasien untuk memulai</p>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Form (Activated via JS) -->
    <div id="registrationForm" class="hidden animate-in zoom-in-95 duration-300">
        <div class="card-premium overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-red-500 text-white flex items-center justify-between shadow-lg shadow-red-100 relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-sm font-black uppercase tracking-widest">Registrasi Kunjungan Pasien</h3>
                    <p class="text-[10px] font-bold text-red-100 mt-1">Lengkapi data kehadiran di bawah ini</p>
                </div>
                <i data-lucide="user-check" class="w-12 h-12 text-white/20 absolute -right-2 -bottom-2 z-0"></i>
            </div>
            
            <form action="{{ route('kunjungan.store') }}" method="POST">
                @csrf
                <div class="p-8 lg:p-10 space-y-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                        
                        <!-- Left Fieldset -->
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pasien Terpilih</label>
                                <div class="relative">
                                    <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-red-500"></i>
                                    <input type="hidden" name="anak_id" id="anak_id">
                                    <input type="text" name="nama" id="namaAnak" readonly
                                           class="w-full bg-slate-100 border-none rounded-2xl pl-12 pr-6 py-4 text-sm font-black text-slate-700 outline-none">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Jenis Layanan Terapi</label>
                                <select name="jenis_terapi" id="jenis_terapi" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    <option value="" selected disabled>-- Pilih Jenis Terapi --</option>
                                    <option value="terapi_perilaku">Terapi Perilaku (Behavior)</option>
                                    <option value="fisioterapi">Fisioterapi & Sensor Integrasi</option>
                                </select>
                            </div>

                            <!-- Package Quick Info (Styled via JS update) -->
                            <div id="paket-info-container" class="hidden">
                                <div id="paket-info-content" class="p-6 rounded-2xl border-2 border-dashed transition-all duration-300">
                                    <!-- Dynamic Content -->
                                </div>
                            </div>
                        </div>

                        <!-- Right Fieldset -->
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis Pelaksana</label>
                                <select name="terapis_id" id="terapis_id" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold">
                                    <option value="">Silakan pilih jenis layanan...</option>
                                </select>
                                <div id="loading-terapis" class="hidden text-center py-2 animate-pulse">
                                    <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest">Sinkronisasi Data Terapis...</span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Kehadiran</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <!-- Hadir -->
                                    <label class="relative group cursor-pointer">
                                        <input type="radio" name="status" value="hadir" checked class="peer sr-only">
                                        <div class="p-4 border-2 border-slate-100 rounded-2xl transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 text-center group-hover:bg-slate-50">
                                            <i data-lucide="check-circle-2" class="w-6 h-6 mx-auto mb-2 text-slate-300 peer-checked:text-emerald-500"></i>
                                            <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Hadir</span>
                                        </div>
                                    </label>
                                    <!-- Izin -->
                                    <label class="relative group cursor-pointer">
                                        <input type="radio" name="status" value="izin" class="peer sr-only">
                                        <div class="p-4 border-2 border-slate-100 rounded-2xl transition-all peer-checked:border-amber-500 peer-checked:bg-amber-50 text-center group-hover:bg-slate-50">
                                            <i data-lucide="mail" class="w-6 h-6 mx-auto mb-2 text-slate-300 peer-checked:text-amber-500"></i>
                                            <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Izin</span>
                                        </div>
                                    </label>
                                    <!-- Sakit -->
                                    <label class="relative group cursor-pointer">
                                        <input type="radio" name="status" value="sakit" class="peer sr-only">
                                        <div class="p-4 border-2 border-slate-100 rounded-2xl transition-all peer-checked:border-blue-500 peer-checked:bg-blue-50 text-center group-hover:bg-slate-50">
                                            <i data-lucide="thermometer" class="w-6 h-6 mx-auto mb-2 text-slate-300 peer-checked:text-blue-500"></i>
                                            <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Sakit</span>
                                        </div>
                                    </label>
                                    <!-- Hangus -->
                                    <label class="relative group cursor-pointer">
                                        <input type="radio" name="status" value="izin_hangus" class="peer sr-only">
                                        <div class="p-4 border-2 border-slate-100 rounded-2xl transition-all peer-checked:border-red-500 peer-checked:bg-red-50 text-center group-hover:bg-slate-50">
                                            <i data-lucide="zap-off" class="w-6 h-6 mx-auto mb-2 text-slate-300 peer-checked:text-red-500"></i>
                                            <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Izin Hangus</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 border-t border-slate-50 bg-slate-50/30 text-right gap-4 flex justify-end">
                    <button type="reset" class="bg-white border border-slate-200 text-slate-500 py-3 px-8 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-100 transition-all">
                        Reset Form
                    </button>
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-3 px-12 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-red-100">
                        Simpan Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Init Lucide
        lucide.createIcons();

        // Tampilkan form pendaftaran saat pasien dipilih
        $('.kirim-data').click(function() {
            const anakId = $(this).data('id');
            const namaAnak = $(this).data('nama');

            $('#anak_id').val(anakId);
            $('#namaAnak').val(namaAnak);

            const form = $('#registrationForm');
            form.removeClass('hidden').hide().slideDown('slow', function() {
                $('html, body').animate({
                    scrollTop: form.offset().top - 40
                }, 500);
            });

            resetTerapisForm();
        });

        $('#jenis_terapi').change(function() {
            const jenisTerapi = $(this).val();
            const anakId = $('#anak_id').val();

            if (jenisTerapi) {
                $('#terapis_id').prop('disabled', false);
                loadTerapisByJenisTerapi();
                if (anakId) {
                    loadPaketInfo(anakId, jenisTerapi);
                }
            } else {
                resetTerapisForm();
                $('#paket-info-container').fadeOut();
            }
        });

        function loadPaketInfo(anakId, jenisTerapi) {
            const container = $('#paket-info-container');
            const content = $('#paket-info-content');

            $.ajax({
                url: '{{ route("pemasukkan.layanan") }}',
                type: 'GET',
                data: { anak_id: anakId },
                success: function(response) {
                    // Gunakan 'paket_terbeli' dari response KeuanganController
                    if (response.paket_terbeli && response.paket_terbeli.length > 0) {
                        // Cari paket yang sesuai dengan jenis terapi yang sedang dipilih dan masih ada sisa
                        let p = response.paket_terbeli.find(item => {
                            return item.sisa > 0 && item.jenis_terapi === jenisTerapi;
                        });
                        
                        // Karena kita butuh filter berdasarkan jenis_terapi (terapi_perilaku / fisioterapi)
                        // Kita asumsikan data dari paket_terbeli sudah mencakup info tersebut via relationship
                        // Namun untuk lebih akurat, kita saring lagi di sini jika ada info jenis_terapi
                        
                        if (p) {
                            let sisa = p.sisa;
                            let borderClass = sisa <= 2 ? "border-red-200 bg-red-50/30" : "border-emerald-200 bg-emerald-50/30";
                            let textClass = sisa <= 2 ? "text-red-600" : "text-emerald-700";
                            
                            content.html(`
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] mb-1">Paket Aktif Ditemukan</h4>
                                        <p class="text-xs font-black ${textClass}">${p.nama.replace('[SUDAH DIBELI] ', '')}</p>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-2xl font-black ${textClass} tracking-tighter">${sisa} <span class="text-[10px] font-bold uppercase ml-1">Sesi Sisa</span></h3>
                                        ${sisa <= 2 ? '<p class="text-[8px] font-black text-red-500 uppercase mt-1 animate-pulse"><i data-lucide="alert-triangle" class="w-3 h-3 inline"></i> Hampir Habis!</p>' : ''}
                                    </div>
                                </div>
                            `);
                            container.removeClass('hidden').hide().fadeIn();
                            content.removeClass('border-red-200 bg-red-50/30 border-emerald-200 bg-emerald-50/30').addClass(borderClass);
                        } else {
                            showNoPacket(content, container);
                        }
                    } else {
                        showNoPacket(content, container);
                    }
                    lucide.createIcons();
                }
            });
        }

        function showNoPacket(content, container) {
            content.html(`
                <div class="text-center p-2">
                    <p class="text-xs font-black text-red-600 uppercase italic"><i data-lucide="x-circle" class="w-4 h-4 inline mr-1"></i> Tidak Ada Paket Aktif</p>
                    <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">Silakan lakukan pembayaran paket terlebih dahulu</p>
                </div>
            `);
            container.removeClass('hidden').hide().fadeIn();
            content.removeClass('border-emerald-200 bg-emerald-50/30 border-red-200 bg-red-50/30').addClass('border-red-100 bg-slate-50/50');
        }

        function resetTerapisForm() {
            $('#terapis_id').html('<option value="" selected disabled>Pilih Jenis Terapi Terlebih Dahulu</option>').prop('disabled', true);
            $('#paket-info-container').hide();
        }

        function loadTerapisByJenisTerapi() {
            const jenisTerapi = $('#jenis_terapi').val();
            const terapisSelect = $('#terapis_id');
            const loader = $('#loading-terapis');

            if (!jenisTerapi) return;

            loader.show();
            terapisSelect.prop('disabled', true);

            $.ajax({
                url: '/get-terapis-by-jenis',
                type: 'GET',
                data: { jenis_terapi: jenisTerapi },
                success: function(response) {
                    let options = '<option value="" selected disabled>-- Pilih Terapis Pelaksana --</option>';
                    if (response.length > 0) {
                        $.each(response, function(idx, t) {
                            options += `<option value="${t.id}">${t.nama.toUpperCase()}</option>`;
                        });
                    } else {
                        options = '<option value="" disabled>TIDAK ADA TERAPIS TERSEDIA</option>';
                    }
                    terapisSelect.html(options).prop('disabled', false);
                },
                complete: function() { loader.hide(); }
            });
        }
    });
</script>
@endsection
