<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets') }}/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets') }}/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link @yield('menuDashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item @yield('masterShow')">
                    <a href="#" class="nav-link @yield('menuMaster')">
                        <i class="nav-icon fas fa-solid fa-bars"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/anak" class="nav-link @yield('menuAnak')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Anak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/terapis" class="nav-link @yield('menuTerapis')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Terapis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/program" class="nav-link @yield('menuProgram')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Program Anak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pelatihan" class="nav-link @yield('menuPelatihan')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pelatihan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @yield('masterLogin')">
                    <a href="#" class="nav-link @yield('menuLogin')">
                        <i class="nav-icon fas fa-solid fa-users"></i>
                        <p>
                            User Login
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/user" class="nav-link @yield('menuUserlogin')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/useranak" class="nav-link @yield('menuAnaklogin')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Login Anak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/userterapis" class="nav-link @yield('menuTerapislogin')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Login Terapis</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @yield('masterKeuangan')">
                    <a href="#" class="nav-link @yield('menuKeuangan')">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Keuangan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('keuangan.rekap') }}" class="nav-link @yield('menuRekap')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rekapan Kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keuangan.pemasukkan') }}" class="nav-link @yield('menuPemasukkan')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pemasukan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keuangan.pengeluaran') }}" class="nav-link @yield('menuPengeluaran')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keuangan.kategori') }}" class="nav-link @yield('menuKategori')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/observasi" class="nav-link @yield('menuObservasi')">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>
                            Observasi
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="/kunjungan" class="nav-link @yield('menuKunjungan')">
                        <i class="nav-icon fa fa-file-contract"></i>
                        <p>
                            Pendaftaran
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/data" class="nav-link @yield('menuRekammedis')">
                        <i class="nav-icon fa fa-clipboard-list"></i>
                        <p>
                            Rekam Medis Anak
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/jadwal" class="nav-link @yield('menuJadwal')">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Jadwal Anak
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profile" class="nav-link @yield('menuProfile')">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profile" class="nav-link @yield('menuCareer')">
                        <i class="nav-icon fas fa-solid fa-paperclip"></i>
                        <p>
                            Career
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profile" class="nav-link @yield('menuBayar')">
                        <i class="nav-icon fa fa-solid fa-file-invoice-dollar"></i>
                        <p>
                            Pembayaran
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profile" class="nav-link @yield('menukontrak')">
                        <i class="nav-icon fa fa-solid fa-handshake"></i>
                        <p>
                            Kontrak Karyawan
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
