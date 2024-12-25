@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuAnak', 'active')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('assets') }}/adminlte/dist/img/user4-128x128.jpg"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $anak->nama }}</h3>
                                @if ($anak->jenis_kelamin == 'L')
                                    <p class="text-muted text-center">Laki - Laki</p>
                                @else
                                    <p class="text-muted text-center">Perempuan</p>
                                @endif

                                <h4>{{ $anak->usia }} Tahun</h4>
                            </div>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Biodata Anak</h3>
                            </div>

                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Pendidikan</strong>

                                <p class="text-muted">
                                    {{ $anak->pendidikan }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                                <p class="text-muted">{{ $anak->alamat }}</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Diagnosa</strong>

                                <p class="text-muted">
                                    {{ $anak->diagnosa }}
                                </p>

                                <hr>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <div class="row">
                                    <div class="col-md-10">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                                    data-toggle="tab">Riwayat</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#timeline"
                                                    data-toggle="tab">Aktivitas
                                                    Anak</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#settings"
                                                    data-toggle="tab">Grafik
                                                    Perkembangan</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('anak.index') }}" class="btn btn-sm btn-warning float-right">
                                            Kembali</a>
                                    </div>
                                </div>


                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                {{-- <table class="table table-hover table-responsive"> --}}
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Pertemuan</th>
                                                        <th scope="col">Tanggal</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kunjungan as $kun)
                                                        <tr class="text-center">
                                                            <td scope="row">
                                                                {{ $kunjungan->firstItem() + $loop->iteration - 1 }}
                                                            </td>
                                                            <td style="text-transform: capitalize;">{{ $kun->pertemuan }}
                                                            </td>
                                                            <td style="text-transform: capitalize;">{{ $kun->created_at }}
                                                            </td>
                                                            <td>
                                                                @if ($kun->status == 'hadir')
                                                                    <label
                                                                        class="badge badge-success">{{ $kun->status }}</label>
                                                                @endif
                                                                @if ($kun->status == 'izin')
                                                                    <label
                                                                        class="badge badge-warning">{{ $kun->status }}</label>
                                                                @endif
                                                                @if ($kun->status == 'sakit')
                                                                    <label
                                                                        class="badge badge-danger">{{ $kun->status }}</label>
                                                                @endif
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="mx-auto mt-3">
                                                    {{ $kunjungan->fragment('judul')->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        @foreach ($kunjungan as $kun)
                                            <div class="timeline timeline-inverse">
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                    @if ($kun->status == 'hadir')
                                                        <span class="bg-success">
                                                            {{ $kun->created_at }}
                                                        </span>
                                                    @else
                                                        <span class="bg-danger">
                                                            {{ $kun->created_at }}
                                                        </span>
                                                    @endif

                                                </div>
                                                <div>
                                                    <i class="fas fa-comments bg-warning"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i>
                                                            {{ $kun->status }}</span>

                                                        <h3 class="timeline-header"><a
                                                                href="">{{ $kun->terapis->nama }}</a>
                                                        </h3>
                                                        @foreach ($kun->pemeriksaans as $p)
                                                            <div class="timeline-body">
                                                                @if ($loop->first)
                                                                    {{ $p->keterangan }}
                                                                @endif
                                                            </div>


                                                            <div class="timeline-footer">
                                                                <a href="#"
                                                                    class="btn btn-warning btn-flat btn-sm">View
                                                                    comment</a>
                                                            </div>
                                                        @break
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>





                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience"
                                                class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills"
                                                    placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms
                                                            and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
