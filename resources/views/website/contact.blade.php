@extends('website.master')
@section('menuContact', 'nav-link-active')

@section('content')
    <!-- Page Header -->
    <section class="relative pt-32 pb-24 bg-brand-slate overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-red/10 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.3em] mb-4 italic animate-in fade-in slide-in-from-bottom-2">Terhubung Dengan Kami</h5>
            <h1 class="text-4xl lg:text-6xl font-black text-white uppercase italic tracking-tight mb-8 animate-in fade-in slide-in-from-bottom-4">Kontak Kami</h1>
            <nav class="flex justify-center">
                <ol class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-slate-500">
                    <li><a href="/" class="hover:text-brand-red transition-colors">Beranda</a></li>
                    <li class="w-1 h-1 bg-slate-700 rounded-full"></li>
                    <li class="text-slate-300">Hubungi Kami</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-20">
                <!-- Contact Info -->
                <div class="lg:w-2/5 space-y-12 uppercase tracking-tight">
                    <div class="space-y-4">
                        <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Informasi Kontak</h5>
                        <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic tracking-tight">Siap Membantu Anda</h2>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium lowercase first-letter:uppercase">Kami siap menjawab pertanyaan Anda tentang layanan terapi kami. Silakan hubungi kami melalui saluran informasi di bawah ini.</p>
                    </div>

                    <div class="space-y-8">
                        <!-- Address -->
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-brand-slate group-hover:bg-brand-red group-hover:text-white transition-all shadow-sm shrink-0 border border-slate-100">
                                <i data-lucide="map-pin" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h6 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-1 italic">Alamat Klinik</h6>
                                <p class="text-[10px] font-bold text-slate-400 uppercase leading-snug max-w-xs">{{ $profile->alamat }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-brand-slate group-hover:bg-brand-red group-hover:text-white transition-all shadow-sm shrink-0 border border-slate-100">
                                <i data-lucide="phone" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h6 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-1 italic">Telepon & WhatsApp</h6>
                                <p class="text-[10px] font-bold text-slate-400 uppercase leading-snug">{{ $profile->telepon }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-brand-slate group-hover:bg-brand-red group-hover:text-white transition-all shadow-sm shrink-0 border border-slate-100">
                                <i data-lucide="mail" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h6 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-1 italic">Email Resmi</h6>
                                <p class="text-[10px] font-bold text-slate-400 uppercase leading-snug">{{ $profile->email }}</p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-brand-slate group-hover:bg-brand-red group-hover:text-white transition-all shadow-sm shrink-0 border border-slate-100">
                                <i data-lucide="clock" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h6 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-1 italic">Jam Operasional</h6>
                                <p class="text-[10px] font-bold text-slate-400 uppercase leading-snug">Senin-Jumat: 09.00-17.00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-12 border-t border-slate-100">
                        <h6 class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mb-6 italic">Ikuti Media Sosial Kami</h6>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-brand-slate hover:bg-brand-red hover:text-white transition-all"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                            <a href="#" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-brand-slate hover:bg-brand-red hover:text-white transition-all"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                            <a href="#" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-brand-slate hover:bg-brand-red hover:text-white transition-all"><i data-lucide="twitter" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:w-3/5">
                    <div class="bg-slate-50 rounded-[3rem] p-8 lg:p-16 border border-slate-100 shadow-sm uppercase tracking-tight">
                        <h3 class="text-2xl font-black text-brand-slate uppercase italic tracking-tight mb-8">Kirimkan <span class="text-brand-red">Inquiry</span> Anda</h3>
                        
                        <form id="contactForm" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-brand-slate uppercase tracking-widest ml-1">Nama Orang Tua</label>
                                    <input type="text" name="nama_org_tua" required class="w-full bg-white border-2 border-slate-100 rounded-2xl px-6 py-4 text-xs font-bold text-brand-slate focus:border-brand-red focus:ring-0 transition-all placeholder:text-slate-300" placeholder="CONTOH: BUDI SANTOSO">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-brand-slate uppercase tracking-widest ml-1">Nama Buah Hati</label>
                                    <input type="text" name="nama_anak" required class="w-full bg-white border-2 border-slate-100 rounded-2xl px-6 py-4 text-xs font-bold text-brand-slate focus:border-brand-red focus:ring-0 transition-all placeholder:text-slate-300" placeholder="CONTOH: ANDI">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-brand-slate uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                                <input type="text" name="telepon" required class="w-full bg-white border-2 border-slate-100 rounded-2xl px-6 py-4 text-xs font-bold text-brand-slate focus:border-brand-red focus:ring-0 transition-all placeholder:text-slate-300" placeholder="CONTOH: 0812XXXXXX">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-brand-slate uppercase tracking-widest ml-1">Pesan / Keluhan</label>
                                <textarea name="pesan" rows="5" required class="w-full bg-white border-2 border-slate-100 rounded-2xl px-6 py-4 text-xs font-bold text-brand-slate focus:border-brand-red focus:ring-0 transition-all placeholder:text-slate-300 resize-none" placeholder="JELASKAN KEBUTUHAN ATAU KELUHAN ANAK ANDA..."></textarea>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full bg-brand-slate text-white py-5 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-brand-red transition-all italic shadow-lg shadow-brand-slate/10">Kirim Pesan Sekarang</button>
                            </div>
                            
                            <p class="text-center text-[9px] font-bold text-slate-400 uppercase tracking-widest">Tim kami akan merespon dalam waktu maksimal 1x24 jam kerja.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="h-[600px] w-full grayscale contrast-125 hover:grayscale-0 transition-all duration-1000">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2092.6676644627596!2d122.11412577453203!3d-3.8650925503181672!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d984f00566d4c67%3A0xc374c04b7f4c6d23!2sTerapi%20Anak%20Berkebutuhan%20Khusus!5e1!3m2!1sen!2sid!4v1748236403190!5m2!1sen!2sid"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <!-- FAQ Section Quick Link -->
    <section class="py-32 bg-slate-50 text-center uppercase tracking-tight">
        <div class="max-w-4xl mx-auto px-6 space-y-8">
            <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Butuh Jawaban Cepat?</h5>
            <h2 class="text-3xl font-black text-brand-slate uppercase italic tracking-tight italic">Mungkin Jawaban Anda Ada Di Daftar FAQ Kami</h2>
            <div class="pt-8">
                <a href="/services#faq" class="inline-flex items-center gap-4 bg-white border border-slate-200 px-10 py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest text-brand-slate hover:border-brand-red hover:text-brand-red transition-all italic shadow-sm">
                    Lihat Pertanyaan Umum
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
