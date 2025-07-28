@extends('mobile.master')
@section('mobileResult', 'active')
@section('style')
    <style>
        .file-link {
            color: #4A86E8;
            text-decoration: none;
            position: relative;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
            font-weight: 500;
        }

        .file-link:hover {
            color: #3a76d8;
        }

        .file-link:before {
            content: "\f1c1";
            font-family: "Font Awesome 5 Free";
            margin-right: 8px;
            font-size: 16px;
        }
    </style>
@endsection
@section('content')
    <header class="header header-fixed">
        <div class="header-content">
            <div class="left-content">
                <a href="javascript:void(0);" class="menu-toggler bg-white pe-2 rounded-xl">
                    <div class="media">
                        <div class="media-35 m-r10">

                            <img class="rounded-xl"
                                src=" {{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/avatar/1.png') }}"
                                alt="">
                        </div>
                        <h6 class="mb-0 font-13">Hello’ {{ $anak->nama }}</h6>
                    </div>
                </a>
            </div>
            <div class="mid-content"></div>
        </div>
    </header>
    <main class="page-content p-t50 p-b50">
        <div class="container">
            <div class="default-tab style-2 mt-1">
                <div class="tab-content">
                    <div class="accordion dz-accordion" id="accordionExample">

                        <div class="accordion-item">
                            <div class="accordion-header acco-select" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <div class="dz-icon">
                                        <i class="fi fi-rr-document"></i>
                                    </div>
                                    <h6 class="acco-title">Data Assessment</h6>
                                    <div class="checkmark"></div>
                                </button>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @foreach ($assessment as $a)
                                        <div class="dz-card list list-style-3">
                                            <div class="dz-content d-flex flex-column">
                                                <table>
                                                    <tr>
                                                        <td width="40%">
                                                            <div class="dz-quantity">Tanggal Pemeriksaan
                                                            </div>
                                                        </td>
                                                        <td width="5%">
                                                            <div class="dz-quantity">:
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dz-quantity">
                                                                {{ \Carbon\Carbon::parse($a->tanggal_assessment)->translatedFormat('d F Y') }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="35%">
                                                            <div class="dz-quantity">Psikolog
                                                            </div>
                                                        </td>
                                                        <td width="5%">
                                                            <div class="dz-quantity">:
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dz-quantity">
                                                                {{ $a->psikolog->nama }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="35%">
                                                            <div class="dz-quantity">Status
                                                            </div>
                                                        </td>
                                                        <td width="5%">
                                                            <div class="dz-quantity">:
                                                            </div>
                                                        </td>
                                                        <td class="text-green">
                                                            <div class="dz-quantity">
                                                                @if ($a->persetujuan_psikolog == 1)
                                                                    <strong>Tervalidasi</strong>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="35%">
                                                            <div class="dz-quantity">Link Download
                                                            </div>
                                                        </td>
                                                        <td width="5%">
                                                            <div class="dz-quantity">:
                                                            </div>
                                                        </td>
                                                        <td>

                                                            @if ($a->persetujuan_psikolog == 1)
                                                                <a href="{{ route('assessment.cetak', ['assessment' => $a->id]) }}"
                                                                    class="file-link" title="Cetak" target="_blank"
                                                                    onclick="window.open(this.href).print(); return false;">
                                                                    assessment.pdf
                                                                </a>
                                                            @endif

                                                        </td>
                                                    </tr>

                                                </table>

                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </main>
@endsection
