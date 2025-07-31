<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <span class="brand-text ml-4" style="font-size: 1.2rem; font-weight: 400;">
            <span style="color: #fff; text-shadow: 0 0 5px #ffc107, 0 0 10px #ffc107;">Bright</span>
            <span style="color: #fff; text-shadow: 0 0 5px #ffc107, 0 0 10px #ffc107;">Star</span>
            <span style="color: #fff; text-shadow: 0 0 5px #17a2b8, 0 0 10px #17a2b8;">Of</span>
            <span style="color: #fff; text-shadow: 0 0 5px #17a2b8, 0 0 10px #17a2b8;">Child</span>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets') }}/images/faces-clipart/pic-2.png" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/home" class="nav-link @yield('menuDashboard')">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item @yield('masterShow')">
                    @canany(['view anak', 'view terapis', 'view program anak', 'view pelatihan'])
                        <a href="#" class="nav-link @yield('menuMaster')">
                            <i class="nav-icon fas fa-solid fa-bars"></i>
                            <p>
                                Master Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endcanany
                    <ul class="nav nav-treeview">
                        @can('view anak')
                            <li class="nav-item">
                                <a href="/anak" class="nav-link @yield('menuAnak')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Anak</p>
                                </a>
                            </li>
                        @endcan

                        @can('view terapis')
                            <li class="nav-item">
                                <a href="/terapis" class="nav-link @yield('menuTerapis')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Terapis</p>
                                </a>
                            </li>
                        @endcan

                        @can('view psikolog')
                            <li class="nav-item">
                                <a href="/psikolog" class="nav-link @yield('menuPsikolog')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Psikolog</p>
                                </a>
                            </li>
                        @endcan

                        @can('view program anak')
                            <li class="nav-item">
                                <a href="/program" class="nav-link @yield('menuProgram')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Program Anak</p>
                                </a>
                            </li>
                        @endcan

                        @can('view tarif')
                            <li class="nav-item">
                                <a href="/tarif" class="nav-link @yield('menuTarif')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peket Terapi</p>
                                </a>
                            </li>
                        @endcan

                        @can('view pelatihan')
                            <li class="nav-item">
                                <a href="/pelatihan" class="nav-link @yield('menuPelatihan')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pelatihan</p>
                                </a>
                            </li>
                        @endcan

                        <li class="nav-item @yield('deteksiShow')">
                            <a href="#" class="nav-link @yield('menuDeteksi')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Deteksi Dini
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('question.umur') }}" class="nav-link @yield('deteksiUmur')">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Master Umur</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('question.pendengaran') }}" class="nav-link @yield('deteksiPendengaran')">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Pendengaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('question.penglihatan') }}" class="nav-link @yield('deteksiPenglihatan')">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Penglihatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('question.perilaku') }}" class="nav-link @yield('deteksiPerilaku')">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Perilaku</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('question.autis') }}" class="nav-link @yield('deteksiAutis')">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Autis</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('question.gpph') }}" class="nav-link @yield('deteksiGpph')">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>GPPH</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('question.wawancara') }}" class="nav-link @yield('deteksiWawancara')">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Wawancara</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @yield('masterLogin')">
                    @canany(['view role', 'view permission', 'view user', 'view manajemen menu'])
                        <a href="#" class="nav-link @yield('menuLogin')">
                            <i class="nav-icon fas fa-solid fa-users"></i>
                            <p>
                                Manajemen User
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endcanany
                    <ul class="nav nav-treeview">
                        @can('view role')
                            <li class="nav-item">
                                <a href="/roles" class="nav-link @yield('menuRoles')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles/Group</p>
                                </a>
                            </li>
                        @endcan
                        @can('view permission')
                            <li class="nav-item">
                                <a href="/permissions" class="nav-link @yield('menuPermissions')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                        @endcan
                        @can('view user')
                            <li class="nav-item">
                                <a href="/users" class="nav-link @yield('menuUserlogin')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User/Pengguna</p>
                                </a>
                            </li>
                        @endcan
                        @can('view manajemen menu')
                            <li class="nav-item">
                                <a href="/manajemen-menu" class="nav-link @yield('menuMenu')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manajemen Menu</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>


                <li class="nav-item @yield('masterKeuangan')">
                    @canany(['view rekapan kas', 'view pemasukkan', 'view pengeluaran', 'view kategori'])
                        <a href="#" class="nav-link @yield('menuKeuangan')">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Keuangan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endcanany
                    <ul class="nav nav-treeview">
                        @can('view rekapan kas')
                            <li class="nav-item">
                                <a href="{{ route('keuangan.rekap') }}" class="nav-link @yield('menuRekap')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekapan Kas</p>
                                </a>
                            </li>
                        @endcan
                        @can('view pemasukkan')
                            <li class="nav-item">
                                <a href="{{ route('keuangan.pemasukkan') }}" class="nav-link @yield('menuPemasukkan')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pemasukan</p>
                                </a>
                            </li>
                        @endcan
                        @can('view pengeluaran')
                            <li class="nav-item">
                                <a href="{{ route('keuangan.pengeluaran') }}" class="nav-link @yield('menuPengeluaran')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengeluaran</p>
                                </a>
                            </li>
                        @endcan
                        @can('view kategori')
                            <li class="nav-item">
                                <a href="{{ route('keuangan.kategori') }}" class="nav-link @yield('menuKategori')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                        @endcan
                        @can('view laporan keuangan')
                            <li class="nav-item">
                                <a href="{{ route('keuangan.laporan') }}" class="nav-link @yield('menuLaporanKeuangan')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Keuangan</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="nav-item @yield('masterLayananterapi')">
                    @canany([
                        'view observasi',
                        'view assessment',
                        'view pendaftaran',
                        'view rekammedis',
                        'view jadwal
                        anak',
                        ])
                        <a href="#" class="nav-link @yield('menuLayananterapi')">
                            <i class="nav-icon fa fa-address-book"></i>
                            <p>
                                Layanan Terapi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endcanany
                    <ul class="nav nav-treeview">
                        @can('view observasi')
                            <li class="nav-item">
                                <a href="/observasi" class="nav-link @yield('menuObservasi')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Observasi
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @if (Auth::user()->hasAnyRole(['psikolog', 'super-admin', 'admin', 'terapis']))
                            @can('view assessment')
                                <li class="nav-item">
                                    <a href="/assessment" class="nav-link @yield('menuAssessment')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Assessment
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        @endif
                        @can('view pendaftaran')
                            <li class="nav-item">
                                <a href="/kunjungan" class="nav-link @yield('menuKunjungan')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Pendaftaran
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('view rekammedis')
                            <li class="nav-item">
                                <a href="/data" class="nav-link @yield('menuRekammedis')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Rekam Medis Anak
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('view jadwal anak')
                            <li class="nav-item">
                                <a href="/jadwal" class="nav-link @yield('menuJadwal')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Jadwal Anak
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="nav-item @yield('masterInformasiprofile')">
                    @canany(['view informasi', 'view profile', 'view profile user'])
                        <a href="#" class="nav-link @yield('menuInformasiprofile')">
                            <i class="nav-icon fa fas fa-house-user"></i>
                            <p>
                                Informasi & Profile
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endcanany
                    <ul class="nav nav-treeview">
                        @can('view informasi')
                            <li class="nav-item">
                                <a href="/informasi" class="nav-link @yield('menuInformasi')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Informasi
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('view profile')
                            <li class="nav-item">
                                <a href="/profile" class="nav-link @yield('menuProfile')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Profile Yayasan
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @if (Auth::user()->hasRole('terapis'))
                            @can('view profile user')
                                <li class="nav-item">
                                    <a href="{{ route('profile.user') }}" class="nav-link @yield('menuProfileuser')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Profile User
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        @endif
                    </ul>
                </li>

                <li class="nav-item @yield('masterEcommerce')">
                    @canany(['view kategori produk', 'view layanan produk'])
                        <a href="#" class="nav-link @yield('menuEcommerce')">
                            <i class="nav-icon fa fas fa-shopping-bag"></i>
                            <p>
                                Toko Online
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endcanany
                    <ul class="nav nav-treeview">
                        {{-- @can('view kategori produk') --}}
                        <li class="nav-item">
                            <a href="/products-category" class="nav-link @yield('menuKategoriproduk')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Kategori Produk
                                </p>
                            </a>
                        </li>
                        {{-- @endcan
                        @can('view Layananproduk') --}}
                        <li class="nav-item">
                            <a href="/products-services" class="nav-link @yield('menuLayananproduk')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Layanan Produk
                                </p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>



                @can('view career')
                    <li class="nav-item">
                        <a href="/career" class="nav-link @yield('menuCareer')">
                            <i class="nav-icon fas fa-solid fa-paperclip"></i>
                            <p>
                                Career
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view pembayaran')
                    <li class="nav-item">
                        <a href="/profile" class="nav-link @yield('menuBayar')">
                            <i class="nav-icon fa fa-solid fa-file-invoice-dollar"></i>
                            <p>
                                Pembayaran
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view kontrak')
                    <li class="nav-item">
                        <a href="/profile" class="nav-link @yield('menukontrak')">
                            <i class="nav-icon fa fa-solid fa-handshake"></i>
                            <p>
                                Kontrak Karyawan
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view Setting')
                    <li class="nav-item @yield('masterWebsite')">
                        @canany(['view rekapan kas', 'view pemasukkan', 'view pengeluaran', 'view kategori'])
                            <a href="#" class="nav-link @yield('menuKeuangan')">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Pengaturan Website
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        @endcanany
                        <ul class="nav nav-treeview">

                        </ul>
                    </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
