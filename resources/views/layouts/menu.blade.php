    {{-- <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : 'collapsed' }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li> --}}

    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-image">
                        <img src="{{ asset('assets') }}/images/faces/face1.jpg" alt="profile" />
                        <span class="login-status online"></span>
                        <!--change to offline or busy as needed-->
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2">Admin</span>
                        <span class="text-secondary text-small">Super Admin</span>
                    </div>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
            <li class="nav-item @yield('menuDashboard')">
                <a class="nav-link" href="/home">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
            <li class="nav-item @yield('menuMaster')">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-title">Master Data</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-tasks menu-icon"></i>
                </a>
                <div class="collapse @yield('masterShow')" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @yield('menuAnak')" href="/anak">Anak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuTerapis')" href="/terapis">Terapis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuProgram')" href="/program">Program Anak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuPelatihan')" href="/pelatihan">Pelatihan</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item @yield('menuObservasi')">
                <a class="nav-link" href="/observasi">
                    <span class="menu-title">Observasi</span>
                    <i class="fa fa-file-powerpoint-o menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/kunjungan">
                    <span class="menu-title">Registrasi</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/data">
                    <span class="menu-title">Data</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#laporan" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-title">Laporan</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
                <div class="collapse" id="laporan">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="/anak">Kehadiran Anak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/terapis">Kinerja Terapis</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/data">
                    <span class="menu-title">Kasir</span>
                    <i class="fa fa-money menu-icon"></i>
                </a>
            </li>
        </ul>
    </nav>
