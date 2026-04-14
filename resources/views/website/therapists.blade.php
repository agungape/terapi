@extends('website.master')
@section('menuTherapists', 'nav-link-active')

@section('content')
    <!-- Page Header -->
    <section class="relative pt-32 pb-24 bg-brand-slate overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-red/10 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.3em] mb-4 italic animate-in fade-in slide-in-from-bottom-2">Keahlian & Dedikasi</h5>
            <h1 class="text-4xl lg:text-6xl font-black text-white uppercase italic tracking-tight mb-8 animate-in fade-in slide-in-from-bottom-4">Terapis Kami</h1>
            <nav class="flex justify-center">
                <ol class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-slate-500">
                    <li><a href="/" class="hover:text-brand-red transition-colors">Beranda</a></li>
                    <li class="w-1 h-1 bg-slate-700 rounded-full"></li>
                    <li class="text-slate-300">Terapis</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Content -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-20">
                <div class="space-y-4 max-w-2xl">
                    <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Tim Terapis Profesional</h5>
                    <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic tracking-tight">Bertemu Dengan Tim Ahli Kami</h2>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium lowercase first-letter:uppercase">Bertemu dengan tim ahli kami yang berdedikasi tinggi untuk membantu perkembangan buah hati Anda melalui pendekatan klinis yang tepat dan penuh kasih sayang.</p>
                </div>
                <div class="shrink-0">
                    <a href="/contact" class="inline-flex items-center gap-3 bg-brand-slate text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-red transition-all italic">Konsultasi Dengan Terapis</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($terapis as $t)
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group border border-slate-100 flex flex-col h-full uppercase tracking-tight">
                    <div class="relative h-[28rem] overflow-hidden bg-slate-100">
                        <img src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/website/images/default-woman.png') }}" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" 
                             alt="Therapist">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-slate/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    
                    <div class="p-8 flex-grow flex flex-col">
                        <h4 class="text-lg font-black text-brand-slate uppercase italic tracking-tight mb-1">{{ $t->nama }}</h4>
                        <p class="text-[9px] font-black text-brand-red uppercase tracking-widest mb-8 border-b border-red-100 pb-2">
                            {{ $t->role === 'terapi_perilaku' ? 'Spesialis Terapi Perilaku' : 'Spesialis Fisioterapi' }}
                        </p>

                        <div class="space-y-6 mb-10">
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-brand-slate group-hover:bg-brand-slate group-hover:text-white transition-colors">
                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Pendidikan</h6>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase leading-snug">{{ $t->jurusan }} {{ $t->perguruan_tinggi }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-brand-slate group-hover:bg-brand-slate group-hover:text-white transition-colors">
                                    <i data-lucide="award" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Sertifikasi</h6>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase leading-snug text-balance">
                                        {{ $t->role === 'terapi_perilaku' ? 'Sertifikasi Terapi Perilaku (ABA)' : 'Sertifikasi Terapi Sensori & Motorik' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-brand-slate group-hover:bg-brand-slate group-hover:text-white transition-colors">
                                    <i data-lucide="history" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Pengalaman</h6>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase leading-snug">
                                        {{ $t->role === 'terapi_perilaku' ? '2 Tahun Menangani ABK' : '1 Tahun Menangani Gangguan Motorik' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto pt-8 border-t border-slate-50 flex justify-between items-center">
                            <div class="flex gap-2">
                                <a href="#" class="w-8 h-8 rounded-lg border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-brand-slate hover:text-white transition-all"><i data-lucide="linkedin" class="w-3.5 h-3.5"></i></a>
                                <a href="#" class="w-8 h-8 rounded-lg border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-brand-red hover:text-white transition-all"><i data-lucide="mail" class="w-3.5 h-3.5"></i></a>
                            </div>
                            <span class="text-[9px] font-black text-brand-slate/50 uppercase tracking-widest italic">Clinical Expert</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-20">
                {{ $terapis->fragment('judul')->links() }}
            </div>
        </div>
    </section>

    <!-- Appointment Banner -->
    <section class="py-20 bg-slate-50 uppercase tracking-tight">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-brand-slate rounded-[3rem] p-12 lg:p-20 relative overflow-hidden text-center lg:text-left">
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-brand-red/20 rounded-full blur-3xl"></div>
                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-12">
                    <div class="space-y-6 max-w-2xl">
                        <h2 class="text-3xl lg:text-4xl font-black text-white px-2">Siap Melangkah Bersama Kami?</h2>
                        <p class="text-slate-400 text-[11px] font-bold leading-relaxed lowercase first-letter:uppercase">Kami siap membantu Anda menemukan terapis yang paling sesuai dengan kebutuhan unik buah hati Anda. Layanan konsultasi awal tersedia untuk memberikan pemahaman mendalam tentang program terapi yang tepat.</p>
                    </div>
                    <div class="shrink-0 flex flex-col sm:flex-row gap-4">
                        <a href="https://wa.me/6285123238404" target="_blank" class="bg-brand-red text-white px-10 py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-brand-slate transition-all italic shadow-2xl shadow-red-500/20">Chat WhatsApp Sekarang</a>
                        <a href="/contact" class="bg-slate-800 text-white px-10 py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-red transition-all italic">Halaman Kontak</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
