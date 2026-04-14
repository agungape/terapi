@extends('website.master')
@section('menuAbout', 'nav-link-active')

@section('content')
    <!-- Page Header -->
    <section class="relative pt-32 pb-24 bg-brand-slate overflow-hidden">
        <!-- Decoration -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-red/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.3em] mb-4 italic animate-in fade-in slide-in-from-bottom-2">Kenali Kami Lebih Dekat</h5>
            <h1 class="text-4xl lg:text-6xl font-black text-white uppercase italic tracking-tight mb-8 animate-in fade-in slide-in-from-bottom-4">Tentang Kami</h1>
            
            <nav class="flex justify-center">
                <ol class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-slate-500">
                    <li><a href="/" class="hover:text-brand-red transition-colors">Beranda</a></li>
                    <li class="w-1 h-1 bg-slate-700 rounded-full"></li>
                    <li class="text-slate-300">Tentang Kami</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-32 bg-white overflow-hidden uppercase tracking-tight">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="flex-1 relative">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white transform -rotate-1 hover:rotate-0 transition-transform duration-700">
                        <img src="{{ asset('assets/website/images/kepala-yayasan.png') }}" alt="Kepala Yayasan" class="w-full h-auto">
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-red-50 rounded-full -z-10 blur-2xl"></div>
                </div>

                <div class="flex-1 space-y-12">
                    <div class="space-y-4">
                        <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Visi & Misi Kami</h5>
                        <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic">Membangun Masa Depan <span class="text-brand-red">Anak Bangsa</span></h2>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium lowercase first-letter:uppercase">Bright Star Of Child didirikan pada tahun 2022 dengan tujuan memberikan layanan terapi yang komprehensif untuk anak-anak berkebutuhan khusus di Sulawesi Tenggara khususnya Kab. Konawe.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <div class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 hover:border-brand-red/20 transition-colors group">
                            <h4 class="text-sm font-black text-brand-slate uppercase italic tracking-widest mb-4 flex items-center gap-3">
                                <span class="w-10 h-10 bg-white shadow-sm rounded-xl flex items-center justify-center text-brand-red group-hover:bg-brand-red group-hover:text-white transition-all"><i data-lucide="eye" class="w-5 h-5"></i></span>
                                Visi Kami
                            </h4>
                            <p class="text-slate-500 text-[11px] font-bold leading-relaxed lowercase first-letter:uppercase">Menjadi pusat terapi anak berkebutuhan khusus terdepan yang memberikan layanan holistik berbasis bukti untuk membantu setiap anak mencapai potensi maksimal mereka.</p>
                        </div>

                        <div class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 hover:border-brand-red/20 transition-colors group">
                            <h4 class="text-sm font-black text-brand-slate uppercase italic tracking-widest mb-6 flex items-center gap-3">
                                <span class="w-10 h-10 bg-white shadow-sm rounded-xl flex items-center justify-center text-brand-red group-hover:bg-brand-red group-hover:text-white transition-all"><i data-lucide="target" class="w-5 h-5"></i></span>
                                Misi Kami
                            </h4>
                            <ul class="space-y-4">
                                <li class="flex items-start gap-4">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-red shrink-0 mt-0.5"></i>
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Memberikan layanan terapi berkualitas dengan pendekatan individual</p>
                                </li>
                                <li class="flex items-start gap-4">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-red shrink-0 mt-0.5"></i>
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Meningkatkan kesadaran masyarakat tentang kebutuhan khusus anak</p>
                                </li>
                                <li class="flex items-start gap-4">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-red shrink-0 mt-0.5"></i>
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Melibatkan keluarga dalam proses terapi untuk hasil yang optimal</p>
                                </li>
                                <li class="flex items-start gap-4">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-red shrink-0 mt-0.5"></i>
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Mengembangkan metode terapi inovatif berbasis penelitian</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-32 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
                <div class="space-y-4">
                    <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Tim Profesional</h5>
                    <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic tracking-tight">Bertemu Dengan Ahli Kami</h2>
                </div>
                <a href="/therapists" class="group flex items-center gap-3 text-[11px] font-black text-brand-slate uppercase tracking-widest border-b-2 border-brand-red pb-2 hover:text-brand-red transition-all">
                    Seluruh Tim Terapis
                    <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($psikolog as $p)
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group border border-slate-100 h-full flex flex-col">
                    <div class="relative h-96 overflow-hidden bg-slate-100">
                        @if ($p->nama == 'Wisnu Catur Bayu, P. M.Psi.,Psikolog')
                            <img src="{{ asset('assets/website/images/default-man.png') }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" alt="Psikolog">
                        @else
                            <img src="{{ asset('assets/website/images/default-woman.png') }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" alt="Psikolog">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-slate/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="p-8 text-center flex-grow flex flex-col items-center">
                        <h4 class="text-base font-black text-brand-slate uppercase italic tracking-tight mb-1">{{ $p->nama }}</h4>
                        <p class="text-[10px] font-black text-brand-red uppercase tracking-widest mb-6 border-b border-red-100 pb-2">Psikolog Klinis</p>
                        <p class="text-[11px] font-bold text-slate-500 leading-relaxed max-w-xs lowercase first-letter:uppercase mb-10">
                            Spesialis dalam assesmen psikologis dan terapi perilaku untuk anak dengan kebutuhan khusus. Memberikan pendampingan holistik untuk tumbuh kembang optimal.
                        </p>
                        <div class="mt-auto flex gap-4">
                            <a href="#" class="w-9 h-9 border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:bg-brand-slate hover:text-white hover:border-brand-slate transition-all"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                            <a href="#" class="w-9 h-9 border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:bg-brand-red hover:text-white hover:border-brand-red transition-all"><i data-lucide="mail" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Nilai-nilai Kami -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20 space-y-4">
                <h5 class="text-xs font-black text-brand-red uppercase tracking-[0.2em] italic">Budaya Layanan</h5>
                <h2 class="text-3xl lg:text-4xl font-black text-brand-slate uppercase italic tracking-tight">Nilai-nilai Utama Kami</h2>
                <div class="w-20 h-1 bg-brand-red mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="p-10 bg-white rounded-[2.5rem] shadow-sm hover:shadow-2xl transition-all border border-slate-100 group">
                    <div class="w-16 h-16 bg-red-50 text-brand-red rounded-3xl flex items-center justify-center mb-8 border border-red-100 group-hover:bg-brand-red group-hover:text-white transition-all">
                        <i data-lucide="heart" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-black text-brand-slate uppercase italic tracking-tight mb-4">Kasih Sayang</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium lowercase first-letter:uppercase">
                        Kami memperlakukan setiap anak dengan kasih sayang dan pengertian, menciptakan lingkungan yang hangat dan mendukung sebagai rumah kedua bagi mereka.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="p-10 bg-white rounded-[2.5rem] shadow-sm hover:shadow-2xl transition-all border border-slate-100 group">
                    <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-3xl flex items-center justify-center mb-8 border border-blue-100 group-hover:bg-blue-500 group-hover:text-white transition-all">
                        <i data-lucide="graduation-cap" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-black text-brand-slate uppercase italic tracking-tight mb-4">Profesionalisme</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium lowercase first-letter:uppercase">
                        Tim kami terdiri dari profesional bersertifikat yang terus mengembangkan keahlian melalui pelatihan berkala untuk standar pelayanan medis terbaik.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="p-10 bg-white rounded-[2.5rem] shadow-sm hover:shadow-2xl transition-all border border-slate-100 group">
                    <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-3xl flex items-center justify-center mb-8 border border-amber-100 group-hover:bg-amber-500 group-hover:text-white transition-all">
                        <i data-lucide="lightbulb" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-black text-brand-slate uppercase italic tracking-tight mb-4">Inovasi</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium lowercase first-letter:uppercase">
                        Kami terus mengembangkan metode terapi berbasis penelitian klinis terbaru untuk memberikan hasil perkembangan yang optimal bagi setiap buah hati.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

