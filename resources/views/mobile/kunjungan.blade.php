@extends('mobile.master')
@section('mobileTerapi', 'active')
@section('content')
    <header class="header header-fixed">
        <div class="header-content">
            <div class="left-content">
                <a href="javascript:void(0);" class="menu-toggler bg-white pe-2 rounded-xl">
                    <div class="media">
                        <div class="media-35 m-r10">
                            <img class="rounded-xl object-cover"
                                src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/avatar.png') }}"
                                alt="Avatar">
                        </div>
                        <h6 class="mb-0 font-14 font-w600 tracking-tight text-slate-800">Hello, {{ $anak->nama }}</h6>
                    </div>
                </a>
            </div>
            <div class="mid-content"></div>
        </div>
    </header>

    <main class="page-content p-t60 p-b60">
        <div class="container">
            <div class="default-tab style-2 mt-1">
                <div class="tab-content">
                    <div class="dz-media d-inline-block p-b20 p-t10">
                        <video style="border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);" width="100%" autoplay muted loop playsinline>
                            <source src="{{ asset('assets/mobile/pixio/videos/banner/video3.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <div class="dz-list m-b20">
                        <ul class="dz-list-group radio style-2">
                            <!-- Section: Behavior Therapy -->
                            <li class="list-group-items mb-3">
                                <label class="radio-label">
                                    <span class="checkmark shadow-sm border-0 bg-slate-50">
                                        <div class="dz-icon style-2 icon-fill bg-slate-900 text-white shadow-lg"><i class="fi fi-rr-document font-18"></i></div>
                                        <div class="list-content">
                                            <h5 class="title font-w700 text-slate-900 italic tracking-tight uppercase font-13">Riwayat Terapi Perilaku</h5>
                                        </div>
                                    </span>
                                </label>
                            </li>

                            @foreach ($groupedBySesi as $sesi => $pertemuan)
                                <div class="accordion dz-accordion mb-3" id="accordionBehavior">
                                    <div class="accordion-item border-0 shadow-sm rounded-2xl overflow-hidden mb-2">
                                        <div class="accordion-header acco-select" id="heading{{ $sesi }}">
                                            <button
                                                class="accordion-button font-w700 font-14 italic tracking-tight {{ $sesiTerakhir === $sesi ? '' : 'collapsed' }} py-3"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $sesi }}"
                                                aria-expanded="{{ $sesiTerakhir === $sesi ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $sesi }}">
                                                <div class="dz-icon me-3 bg-red-50 text-red-500 rounded-lg p-2">
                                                    <i class="fi fi-rr-calendar-clock font-16"></i>
                                                </div>
                                                <h6 class="acco-title uppercase">Season <span class="text-red-500">{{ $sesi }}</span></h6>
                                            </button>
                                        </div>
                                        <div id="collapse{{ $sesi }}"
                                            class="accordion-collapse collapse {{ $sesiTerakhir === $sesi ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $sesi }}"
                                            data-bs-parent="#accordionBehavior">
                                            <div class="accordion-body p-3 bg-slate-50/30">
                                                @foreach ($pertemuan as $kunjungan)
                                                    <div class="dz-card list list-style-3 mb-3 bg-white border border-slate-100 p-3 rounded-2xl">
                                                        <div class="dz-content d-flex flex-column gap-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h6 class="title mb-0">
                                                                    <a href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan->id]) }}" class="font-13 font-w700 text-slate-800 italic">
                                                                        {{ $kunjungan->created_at->translatedFormat('d F Y') }}
                                                                    </a>
                                                                </h6>
                                                                <span class="badge {{ $kunjungan->status == 'hadir' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} font-9 uppercase font-w800 tracking-widest px-2 py-1 radius-sm">
                                                                    {{ $kunjungan->status == 'izin_hangus' ? 'Hangus' : $kunjungan->status }}
                                                                </span>
                                                            </div>

                                                            @if ($kunjungan->status == 'hadir')
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <span class="text-[10px] font-w700 uppercase tracking-widest text-slate-400">Pertemuan {{ $kunjungan->pertemuan }}</span>
                                                                    <span class="h-1 w-1 bg-slate-200 rounded-full"></span>
                                                                    <span class="text-[10px] font-w700 uppercase tracking-widest text-slate-500">Terapis: {{ $kunjungan->terapis->nama ?? '-' }}</span>
                                                                </div>
                                                                
                                                                <div class="mt-2">
                                                                    <a href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan->id]) }}"
                                                                        class="btn btn-dark btn-xs font-10 font-w800 px-4 py-2 uppercase tracking-widest italic rounded-xl w-100 shadow-sm">
                                                                        Detail Laporan
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div> 
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <hr class="my-4 border-slate-100">

                            <!-- Section: Physiotherapy -->
                            <li class="list-group-items mb-3">
                                <label class="radio-label">
                                    <span class="checkmark shadow-sm border-0 bg-slate-50">
                                        <div class="dz-icon style-2 icon-fill bg-red-500 text-white shadow-lg"><i class="fi fi-rr-document font-18"></i></div>
                                        <div class="list-content">
                                            <h5 class="title font-w700 text-slate-900 italic tracking-tight uppercase font-13">Riwayat Fisioterapi</h5>
                                        </div>
                                    </span>
                                </label>
                            </li>

                            @foreach ($groupedBySesi_fisio as $sesi_fisio => $pertemuan_fisio)
                                <div class="accordion dz-accordion mb-3" id="accordionPhysio">
                                    <div class="accordion-item border-0 shadow-sm rounded-2xl overflow-hidden mb-2">
                                        <div class="accordion-header acco-select" id="heading{{ $sesi_fisio }}">
                                            <button
                                                class="accordion-button font-w700 font-14 italic tracking-tight {{ $sesiTerakhir_fisio === $sesi_fisio ? '' : 'collapsed' }} py-3"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $sesi_fisio }}"
                                                aria-expanded="{{ $sesiTerakhir_fisio === $sesi_fisio ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $sesi_fisio }}">
                                                <div class="dz-icon me-3 bg-slate-50 text-slate-900 rounded-lg p-2">
                                                    <i class="fi fi-rr-document font-16"></i>
                                                </div>
                                                <h6 class="acco-title uppercase">Season <span class="text-red-500">{{ $sesi_fisio }}</span></h6>
                                            </button>
                                        </div>
                                        <div id="collapse{{ $sesi_fisio }}"
                                            class="accordion-collapse collapse {{ $sesiTerakhir_fisio === $sesi_fisio ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $sesi_fisio }}"
                                            data-bs-parent="#accordionPhysio">
                                            <div class="accordion-body p-3 bg-slate-50/30">
                                                @foreach ($pertemuan_fisio as $kunjungan_fisioterapi)
                                                    <div class="dz-card list list-style-3 mb-3 bg-white border border-slate-100 p-3 rounded-2xl">
                                                        <div class="dz-content d-flex flex-column gap-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h6 class="title mb-0">
                                                                    <a href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan_fisioterapi->id]) }}" class="font-13 font-w700 text-slate-800 italic">
                                                                        {{ $kunjungan_fisioterapi->created_at->translatedFormat('d F Y') }}
                                                                    </a>
                                                                </h6>
                                                                <span class="badge {{ $kunjungan_fisioterapi->status == 'hadir' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} font-9 uppercase font-w800 tracking-widest px-2 py-1 radius-sm">
                                                                    {{ $kunjungan_fisioterapi->status == 'izin_hangus' ? 'Hangus' : $kunjungan_fisioterapi->status }}
                                                                </span>
                                                            </div>

                                                            @if ($kunjungan_fisioterapi->status == 'hadir')
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <span class="text-[10px] font-w700 uppercase tracking-widest text-slate-400">Pertemuan {{ $kunjungan_fisioterapi->pertemuan }}</span>
                                                                    <span class="h-1 w-1 bg-slate-200 rounded-full"></span>
                                                                    <span class="text-[10px] font-w700 uppercase tracking-widest text-slate-500">Terapis: {{ $kunjungan_fisioterapi->terapis->nama ?? '-' }}</span>
                                                                </div>
                                                                
                                                                <div class="mt-2">
                                                                    <a href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan_fisioterapi->id]) }}"
                                                                        class="btn btn-dark btn-xs font-10 font-w800 px-4 py-2 uppercase tracking-widest italic rounded-xl w-100 shadow-sm">
                                                                        Detail Laporan
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
n>
@endsection
