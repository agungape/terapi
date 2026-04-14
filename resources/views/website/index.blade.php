@extends('website.master')
@section('menuIndex', 'nav-link-active')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-20 pb-32 lg:pt-32 lg:pb-52 overflow-hidden bg-white">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-slate-50 rounded-l-[5rem] -z-10 hidden lg:block"></div>
        <div class="absolute top-20 right-20 w-64 h-64 bg-brand-red/5 rounded-full blur-3xl -z-10 animate-pulse"></div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
                <div class="flex-1 space-y-10">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 rounded-full border border-red-100">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-red opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-red"></span>
                        </span>
                        <span class="text-[10px] font-black text-brand-red uppercase tracking-widest italic">Pusat Terapi Terakreditasi</span>
                    </div>
                    
                    <h1 class="text-4xl lg:text-6xl font-black text-brand-slate uppercase italic tracking-tight leading-[1.1]">
                        Pendampingan <br>
                        <span class="text-brand-red">Khusus</span> Untuk <br>
                        Anak Spesial
                    </h1>
                    
                    <p class="text-slate-500 text-base lg:text-lg leading-relaxed max-w-xl font-medium">
                        Kami memberikan terapi profesional dan pendampingan holistik berbasis bukti untuk membantu setiap anak mencapai potensi terbaiknya dengan cinta dan kepedulian.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="https://wa.me/6285123238404" class="bg-brand-red hover:bg-brand-slate text-white px-10 py-5 rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-2xl shadow-red-100 transition-all flex items-center justify-center gap-3 italic">
                            Konsultasi Gratis
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                        </a>
                        <a href="/services" class="bg-white hover:bg-slate-50 text-brand-slate px-10 py-5 rounded-2xl text-[11px] font-black uppercase tracking-widest border border-slate-100 shadow-sm transition-all flex items-center justify-center gap-3 italic">
                            Layanan Kami
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <div class="flex-1 relative">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl shadow-slate-200 border-4 border-white rotate-2 hover:rotate-0 transition-transform duration-500">
                        <img src="{{ asset('assets/website/images/hero-image.png') }}" alt="Terapi Anak" class="w-full h-auto">
                    </div>
                    <!-- Small Stats Card Floating -->
                    <div class="absolute -bottom-10 -left-10 bg-white p-6 rounded-3xl shadow-2xl border border-slate-50 z-20 hidden md:block animate-bounce">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-red-50 text-brand-red rounded-2xl">
                                <i data-lucide="heart" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Happy Children</p>
                                <p class="text-xl font-black text-brand-slate tabular-nums">{{ $anak }}+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-32 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
                <div class="space-y-4">
                    <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Keunggulan Kami</h5>
                    <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic tracking-tight">Layanan Unggulan Kami</h2>
                    <p class="text-slate-500 text-sm max-w-md font-medium">Berbagai jenis terapi terpadu yang dirancang khusus untuk memenuhi kebutuhan spesifik perkembangan anak Anda.</p>
                </div>
                <a href="/services" class="group flex items-center gap-3 text-[11px] font-black text-brand-slate uppercase tracking-widest border-b-2 border-brand-red pb-2 hover:text-brand-red transition-all">
                    Lihat Semua Layanan
                    <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group border border-slate-100 flex flex-col h-full">
                    <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-3xl flex items-center justify-center mb-8 border border-blue-100 group-hover:bg-blue-500 group-hover:text-white transition-all">
                        <i data-lucide="message-square" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-black text-brand-slate uppercase italic tracking-tight mb-4">Terapi Wicara</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-10 flex-grow font-medium">
                        Membantu anak dengan kesulitan berbicara, berkomunikasi verbal, dan meningkatkan kemampuan mengekspresikan diri secara efektif.
                    </p>
                    <a href="/services" class="inline-flex items-center gap-2 text-[10px] font-black text-brand-red uppercase tracking-widest group/link">
                        Selengkapnya 
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-link-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Service 2 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group border border-slate-100 flex flex-col h-full">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-3xl flex items-center justify-center mb-8 border border-emerald-100 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                        <i data-lucide="move" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-black text-brand-slate uppercase italic tracking-tight mb-4 text-balance">Fisioterapi & Sensor Integrasi</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-10 flex-grow font-medium">
                        Meningkatkan kemampuan koordinasi motorik kasar, keseimbangan, serta kemandirian anak dalam aktivitas sehari-hari.
                    </p>
                    <a href="/services" class="inline-flex items-center gap-2 text-[10px] font-black text-brand-red uppercase tracking-widest group/link">
                        Selengkapnya 
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-link-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Service 3 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group border border-slate-100 flex flex-col h-full">
                    <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-3xl flex items-center justify-center mb-8 border border-amber-100 group-hover:bg-amber-500 group-hover:text-white transition-all">
                        <i data-lucide="brain" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-black text-brand-slate uppercase italic tracking-tight mb-4">Terapi Perilaku (ABA)</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-10 flex-grow font-medium">
                        Pendekatan ilmiah untuk membantu anak mengelola emosi, perilaku sosial, dan membangun kebiasaan positif yang berkelanjutan.
                    </p>
                    <a href="/services" class="inline-flex items-center gap-2 text-[10px] font-black text-brand-red uppercase tracking-widest group/link">
                        Selengkapnya 
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-link-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-brand-slate relative overflow-hidden">
        <div class="absolute inset-0 bg-brand-red opacity-[0.03]"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 md:gap-8">
                <div class="text-center space-y-3">
                    <h3 class="text-5xl lg:text-6xl font-black text-white italic tracking-tighter">{{ $anak }}+</h3>
                    <p class="text-xs font-black text-slate-500 uppercase tracking-[0.3em]">Anak Terbantu</p>
                </div>
                <div class="text-center space-y-3 border-y md:border-y-0 md:border-x border-white/5 py-12 md:py-0">
                    <h3 class="text-5xl lg:text-6xl font-black text-brand-red italic tracking-tighter">{{ count($terapis) }}</h3>
                    <p class="text-xs font-black text-slate-500 uppercase tracking-[0.3em]">Terapis Ahli</p>
                </div>
                <div class="text-center space-y-3">
                    <h3 class="text-5xl lg:text-6xl font-black text-white italic tracking-tighter">3</h3>
                    <p class="text-xs font-black text-slate-500 uppercase tracking-[0.3em]">Bidang Keahlian</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="flex-1 relative">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl skew-y-2 group">
                        <img src="{{ asset('assets/website/images/tentang-kami.png') }}" alt="Tentang Kami" class="w-full h-auto group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand-red rounded-3xl -z-10 rotate-12"></div>
                </div>
                
                <div class="flex-1 space-y-10">
                    <div class="space-y-4">
                        <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Siapa Kami</h5>
                        <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic tracking-tight">Visi Kami Untuk <br>Setiap <span class="text-brand-red underline decoration-red-200 underline-offset-8">Bintang Muda</span></h2>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium">
                            Bright Star of Child adalah pusat terapi terakreditasi yang berdedikasi tinggi untuk memberikan pelayanan terbaik bagi anak berkebutuhan khusus melalui metode klinis yang terukur.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 bg-red-50 text-brand-red rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-brand-red group-hover:text-white transition-all shadow-sm">
                                <i data-lucide="award" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-brand-slate uppercase tracking-widest mb-1 italic">Tenaga Ahli Bersertifikat</h4>
                                <p class="text-slate-400 text-[11px] font-bold leading-relaxed">Seluruh tim terapis kami memiliki latar belakang akademis dan sertifikasi resmi di bidangnya masing-masing.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 bg-red-50 text-brand-red rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-brand-red group-hover:text-white transition-all shadow-sm">
                                <i data-lucide="activity" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-brand-slate uppercase tracking-widest mb-1 italic">Pendekatan Personal</h4>
                                <p class="text-slate-400 text-[11px] font-bold leading-relaxed">Kami memahami bahwa setiap anak unik. Program terapi disusun secara khusus untuk memenuhi target perkembangan individu.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 bg-red-50 text-brand-red rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-brand-red group-hover:text-white transition-all shadow-sm">
                                <i data-lucide="shield-check" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-brand-slate uppercase tracking-widest mb-1 italic">Lingkungan Aman & Ramah</h4>
                                <p class="text-slate-400 text-[11px] font-bold leading-relaxed">Area terapi kami dirancang khusus agar anak-anak merasa nyaman, aman, dan bersemangat dalam setiap sesi.</p>
                            </div>
                        </div>
                    </div>

                    <a href="/about" class="bg-brand-slate hover:bg-brand-red text-white px-10 py-5 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all inline-flex items-center gap-3 italic">
                        Pelajari Profile Kami
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-32 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20 space-y-4">
                <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Kisah Sukses</h5>
                <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic tracking-tight">Apa Kata Orang Tua</h2>
                <div class="w-20 h-1 bg-brand-red mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 relative">
                    <i data-lucide="quote" class="absolute top-10 right-10 w-8 h-8 text-slate-100"></i>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl overflow-hidden">
                            <img src="{{ asset('assets/website/images/family.png') }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h6 class="text-xs font-black text-brand-slate uppercase tracking-widest">Ibu Siti</h6>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Orang Tua Ahmad</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-6">
                        @for($i=0; $i<5; $i++) <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i> @endfor
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed italic font-medium">
                        "Setelah 6 bulan terapi wicara di sini, anak saya sekarang sudah bisa mengucapkan banyak kata dengan jelas. Terima kasih untuk kesabaran terapisnya."
                    </p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-slate-100 relative scale-105 z-10 border-t-4 border-t-brand-red">
                    <i data-lucide="quote" class="absolute top-10 right-10 w-8 h-8 text-red-100"></i>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl overflow-hidden">
                            <img src="{{ asset('assets/website/images/family.png') }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h6 class="text-xs font-black text-brand-slate uppercase tracking-widest">Bapak Budi</h6>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Orang Tua Dinda</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-6">
                        @for($i=0; $i<5; $i++) <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i> @endfor
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed italic font-medium">
                        "Pendekatan terapisnya sangat baik. Anak saya yang dulunya sulit fokus sekarang sudah bisa duduk tenang dan mengikuti instruksi guru di sekolah."
                    </p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 relative">
                    <i data-lucide="quote" class="absolute top-10 right-10 w-8 h-8 text-slate-100"></i>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl overflow-hidden">
                            <img src="{{ asset('assets/website/images/family.png') }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h6 class="text-xs font-black text-brand-slate uppercase tracking-widest">Ibu Dewi</h6>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Orang Tua Raka</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-6">
                        @for($i=0; $i<5; $i++) <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i> @endfor
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed italic font-medium">
                        "Setiap bulan kami diberikan laporan perkembangan yang mendetail. Transparansi seperti ini yang membuat kami tenang mempercayakan Raka di sini."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-brand-red relative overflow-hidden">
        <div class="absolute inset-0 bg-brand-slate opacity-[0.05]"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="text-white text-center lg:text-left space-y-4">
                    <h2 class="text-3xl lg:text-4xl font-black uppercase italic tracking-tight">Siap Membantu Perkembangan <br>Buah Hati Anda?</h2>
                    <p class="text-red-100 text-sm font-medium">Jangan ragu untuk berkonsultasi secara gratis dengan tim profesional kami hari ini.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/6285123238404" class="bg-brand-slate hover:bg-white hover:text-brand-slate text-white px-12 py-5 rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-2xl transition-all flex items-center justify-center gap-3 italic">
                        HUBUNGI KAMI VIA WHATSSAPP
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

