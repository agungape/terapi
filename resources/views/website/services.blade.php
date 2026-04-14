@extends('website.master')
@section('menuServices', 'nav-link-active')

@section('content')
    <!-- Page Header -->
    <section class="relative pt-32 pb-24 bg-brand-slate overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-red/10 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.3em] mb-4 italic animate-in fade-in slide-in-from-bottom-2">Layanan Profesional Kami</h5>
            <h1 class="text-4xl lg:text-6xl font-black text-white uppercase italic tracking-tight mb-8 animate-in fade-in slide-in-from-bottom-4">Layanan Kami</h1>
            <nav class="flex justify-center">
                <ol class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-slate-500">
                    <li><a href="/" class="hover:text-brand-red transition-colors">Beranda</a></li>
                    <li class="w-1 h-1 bg-slate-700 rounded-full"></li>
                    <li class="text-slate-300">Layanan</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Services Content -->
    <section class="py-32 bg-white scroll-mt-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-20">
                <!-- Sidebar Nav -->
                <aside class="lg:w-1/3 xl:w-1/4">
                    <div class="sticky top-28 space-y-8">
                        <div class="bg-slate-50 rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                            <h5 class="text-xs font-black text-brand-slate uppercase tracking-[0.2em] mb-8 border-l-4 border-brand-red pl-4">Daftar Layanan</h5>
                            <nav class="space-y-2">
                                <a href="#speech-therapy" class="flex items-center gap-4 p-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-slate-500 hover:bg-white hover:text-brand-red hover:shadow-sm transition-all group">
                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm group-hover:bg-brand-red group-hover:text-white transition-all"><i data-lucide="message-square" class="w-4 h-4"></i></span>
                                    Terapi Wicara
                                </a>
                                <a href="#behavioral-therapy" class="flex items-center gap-4 p-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-slate-500 hover:bg-white hover:text-brand-red hover:shadow-sm transition-all group">
                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm group-hover:bg-brand-red group-hover:text-white transition-all"><i data-lucide="brain" class="w-4 h-4"></i></span>
                                    Terapi Perilaku
                                </a>
                                <a href="#physiotherapy" class="flex items-center gap-4 p-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-slate-500 hover:bg-white hover:text-brand-red hover:shadow-sm transition-all group">
                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm group-hover:bg-brand-red group-hover:text-white transition-all"><i data-lucide="move" class="w-4 h-4"></i></span>
                                    Fisioterapi
                                </a>
                                <a href="#sensory-integration" class="flex items-center gap-4 p-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-slate-500 hover:bg-white hover:text-brand-red hover:shadow-sm transition-all group">
                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm group-hover:bg-brand-red group-hover:text-white transition-all"><i data-lucide="activity" class="w-4 h-4"></i></span>
                                    Sensori Integrasi
                                </a>
                                <a href="#psychology-assessment" class="flex items-center gap-4 p-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-slate-500 hover:bg-white hover:text-brand-red hover:shadow-sm transition-all group">
                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm group-hover:bg-brand-red group-hover:text-white transition-all"><i data-lucide="clipboard-check" class="w-4 h-4"></i></span>
                                    Assessment
                                </a>
                            </nav>
                        </div>
                        
                        <div class="bg-brand-red rounded-[2rem] p-8 text-white relative overflow-hidden group">
                            <i data-lucide="phone-call" class="absolute -bottom-6 -right-6 w-32 h-32 opacity-10 group-hover:scale-110 transition-transform duration-500"></i>
                            <h4 class="text-sm font-black uppercase italic tracking-tight mb-4 text-balance">Butuh Konsultasi Lebih Lanjut?</h4>
                            <p class="text-[10px] font-bold text-red-50 opacity-90 mb-8 leading-relaxed">Tim kami siap membantu menjawab segala pertanyaan Anda.</p>
                            <a href="https://wa.me/6285123238404" target="_blank" class="w-full bg-white text-brand-red py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest text-center block hover:bg-brand-slate hover:text-white transition-all italic">Chat WhatsApp Sekarang</a>
                        </div>
                    </div>
                </aside>

                <!-- Details -->
                <div class="flex-1 space-y-32">
                    <!-- Speech Therapy -->
                    <div id="speech-therapy" class="scroll-mt-32 uppercase tracking-tight">
                        <div class="flex items-center gap-6 mb-10">
                            <div class="w-16 h-16 bg-red-50 text-brand-red rounded-3xl flex items-center justify-center border border-red-100 shadow-sm">
                                <i data-lucide="message-square" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-3xl font-black text-brand-slate uppercase italic tracking-tight">Terapi Wicara</h3>
                        </div>
                        <p class="text-slate-500 text-sm leading-relaxed lowercase first-letter:uppercase font-medium mb-12 max-w-2xl">
                            Terapi wicara adalah layanan yang ditujukan untuk membantu anak-anak dengan kesulitan dalam berkomunikasi, baik secara verbal maupun non-verbal. Layanan ini mencakup berbagai gangguan bicara dan bahasa yang menghambat interaksi sosial.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                            <div class="p-8 bg-slate-50 rounded-3xl border border-slate-100">
                                <h5 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-6 border-b border-slate-200 pb-3 italic">Manfaat Utama:</h5>
                                <ul class="space-y-4">
                                    <li class="flex items-start gap-3"><i data-lucide="check-circle" class="w-4 h-4 text-brand-red mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Meningkatkan kemampuan artikulasi</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="check-circle" class="w-4 h-4 text-brand-red mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Mengembangkan kosa kata</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="check-circle" class="w-4 h-4 text-brand-red mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Komunikasi fungsional</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="check-circle" class="w-4 h-4 text-brand-red mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Mengatasi gangguan kelancaran</span></li>
                                </ul>
                            </div>
                            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm">
                                <h5 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-6 border-b border-slate-200 pb-3 italic">Indikasi Kebutuhan:</h5>
                                <ul class="space-y-4">
                                    <li class="flex items-start gap-3"><i data-lucide="alert-circle" class="w-4 h-4 text-amber-500 mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Anak 2 tahun belum mengucap kata</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="alert-circle" class="w-4 h-4 text-amber-500 mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ucapan tidak jelas >3 tahun</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="alert-circle" class="w-4 h-4 text-amber-500 mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kosa kata sangat terbatas</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="alert-circle" class="w-4 h-4 text-amber-500 mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sulit menyusun kalimat</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-brand-slate p-1 rounded-2xl">
                             <a href="https://wa.me/6285123238404" class="w-full bg-brand-red text-white py-4 rounded-xl text-[10px] font-black uppercase tracking-widest text-center hover:bg-white hover:text-brand-slate transition-all italic">Konsultasikan Sekarang</a>
                        </div>
                    </div>

                    <!-- Behavioral Therapy -->
                    <div id="behavioral-therapy" class="scroll-mt-32 uppercase tracking-tight">
                        <div class="flex items-center gap-6 mb-10">
                            <div class="w-16 h-16 bg-red-50 text-brand-red rounded-3xl flex items-center justify-center border border-red-100 shadow-sm">
                                <i data-lucide="brain" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-3xl font-black text-brand-slate uppercase italic tracking-tight">Terapi Perilaku (ABA)</h3>
                        </div>
                        <p class="text-slate-500 text-sm leading-relaxed lowercase first-letter:uppercase font-medium mb-12 max-w-2xl">
                            Terapi perilaku membantu anak-anak yang mengalami tantangan emosional atau perilaku seperti tantrum, kesulitan mengikuti instruksi, atau gangguan pemusatan perhatian melalui pendekatan ilmiah yang terstruktur.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                            <div class="p-8 bg-slate-50 rounded-3xl border border-slate-100">
                                <h5 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-6 border-b border-slate-200 pb-3 italic">Manfaat Utama:</h5>
                                <ul class="space-y-4">
                                    <li class="flex items-start gap-3"><i data-lucide="check-circle" class="w-4 h-4 text-brand-red mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Mengurangi perilaku agresif</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="check-circle" class="w-4 h-4 text-brand-red mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Meningkatkan kepatuhan</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="check-circle" class="w-4 h-4 text-brand-red mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Manajemen emosi sehat</span></li>
                                    <li class="flex items-start gap-3"><i data-lucide="check-circle" class="w-4 h-4 text-brand-red mt-0.5 shrink-0"></i> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Keterampilan sosial positif</span></li>
                                </ul>
                            </div>
                            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm">
                                <h5 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-6 border-b border-slate-200 pb-3 italic">Proses Terapi:</h5>
                                <p class="text-[10px] font-bold text-slate-400 leading-relaxed lowercase first-letter:uppercase">Observasi awal untuk menyusun program intervensi spesifik. Sesi berdurasi 45-60 menit, dilakukan 1-2 kali seminggu dengan keterlibatan orang tua.</p>
                            </div>
                        </div>
                         <a href="https://wa.me/6285123238404" class="w-full sm:w-auto bg-brand-slate text-white px-12 py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest text-center hover:bg-brand-red transition-all italic block sm:inline-block">Ambil Janji Konsultasi</a>
                    </div>

                    <!-- Fisioterapi -->
                    <div id="physiotherapy" class="scroll-mt-32 uppercase tracking-tight">
                        <div class="flex items-center gap-6 mb-10">
                            <div class="w-16 h-16 bg-red-50 text-brand-red rounded-3xl flex items-center justify-center border border-red-100 shadow-sm">
                                <i data-lucide="move" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-3xl font-black text-brand-slate uppercase italic tracking-tight">Fisioterapi</h3>
                        </div>
                        <p class="text-slate-500 text-sm leading-relaxed lowercase first-letter:uppercase font-medium mb-12 max-w-2xl">
                            Fisioterapi membantu anak yang mengalami keterlambatan perkembangan motorik kasar, kelemahan otot, atau gangguan gerak untuk meningkatkan kekuatan, koordinasi, dan mobilitas.
                        </p>
                        <div class="bg-slate-50 rounded-3xl p-10 border border-slate-100 mb-12">
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div>
                                    <h5 class="text-[11px] font-black text-brand-slate uppercase tracking-widest mb-6 italic">Target Perkembangan:</h5>
                                    <ul class="space-y-4">
                                        <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 bg-brand-red rounded-full"></span> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Kekuatan Otot & Stabilitas</span></li>
                                        <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 bg-brand-red rounded-full"></span> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Koordinasi & Keseimbangan</span></li>
                                        <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 bg-brand-red rounded-full"></span> <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Keterampilan Berjalan</span></li>
                                    </ul>
                                </div>
                                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                                    <p class="text-[10px] font-bold text-slate-400 leading-relaxed italic lowercase first-letter:uppercase">Fisioterapis kami melakukan evaluasi fisik mendalam untuk rencana kustom. Frekuensi ideal 1-3 kali seminggu berdasarkan kondisi medis.</p>
                                </div>
                             </div>
                        </div>
                         <a href="https://wa.me/6285123238404" class="w-full sm:w-auto bg-brand-red text-white px-12 py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest text-center hover:bg-brand-slate transition-all italic block sm:inline-block shadow-xl shadow-red-100">Hubungi Fisioterapis</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-32 bg-slate-50 uppercase tracking-tight">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-20 space-y-4">
                <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">FAQ</h5>
                <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic tracking-tight">Pertanyaan Umum</h2>
                <div class="w-20 h-1 bg-brand-red mx-auto"></div>
            </div>

            <div class="space-y-4" x-data="{ active: 1 }">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                    <button @click="active = (active === 1 ? 0 : 1)" class="w-full p-8 text-left flex items-center justify-between group">
                        <span class="text-sm font-black text-brand-slate uppercase tracking-widest group-hover:text-brand-red transition-colors">Berapa lama anak perlu mengikuti terapi?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-300 transition-transform duration-300" :class="active === 1 ? 'rotate-180 text-brand-red' : ''"></i>
                    </button>
                    <div x-show="active === 1" x-collapse x-cloak>
                        <div class="px-8 pb-8 pt-0 border-t border-slate-50">
                            <p class="text-slate-500 text-[11px] font-bold leading-relaxed lowercase first-letter:uppercase mt-6">
                                Durasi terapi bervariasi tergantung kondisi anak dan respons terhadap terapi. Rata-rata anak membutuhkan 6-12 bulan terapi intensif sebelum menunjukkan perkembangan signifikan. Terapis akan melakukan evaluasi berkala untuk menyesuaikan program.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                    <button @click="active = (active === 2 ? 0 : 2)" class="w-full p-8 text-left flex items-center justify-between group">
                        <span class="text-sm font-black text-brand-slate uppercase tracking-widest group-hover:text-brand-red transition-colors">Apakah orang tua boleh mengikuti sesi terapi?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-300 transition-transform duration-300" :class="active === 2 ? 'rotate-180 text-brand-red' : ''"></i>
                    </button>
                    <div x-show="active === 2" x-collapse x-cloak>
                        <div class="px-8 pb-8 pt-0 border-t border-slate-50">
                            <p class="text-slate-500 text-[11px] font-bold leading-relaxed lowercase first-letter:uppercase mt-6">
                                Kami sangat menganjurkan orang tua untuk mengamati sesi terapi agar dapat melanjutkan latihan di rumah. Beberapa sesi bahkan dirancang khusus untuk melibatkan orang tua secara aktif dalam proses terapi guna mempercepat hasil.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                    <button @click="active = (active === 3 ? 0 : 3)" class="w-full p-8 text-left flex items-center justify-between group">
                        <span class="text-sm font-black text-brand-slate uppercase tracking-widest group-hover:text-brand-red transition-colors">Bagaimana jika anak rewel saat terapi?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-300 transition-transform duration-300" :class="active === 3 ? 'rotate-180 text-brand-red' : ''"></i>
                    </button>
                    <div x-show="active === 3" x-collapse x-cloak>
                        <div class="px-8 pb-8 pt-0 border-t border-slate-50">
                            <p class="text-slate-500 text-[11px] font-bold leading-relaxed lowercase first-letter:uppercase mt-6">
                                Terapis kami terlatih untuk menangani perilaku anak melalui pendekatan bermain. Rewel di awal adalah hal wajar sebagai bentuk adaptasi dengan lingkungan baru.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

