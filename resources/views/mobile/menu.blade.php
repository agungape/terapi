<div class="sidebar">
    <a href="profile.html" class="author-box">
        <div class="dz-media">
            <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/avatar/small/2.png') }}"
                alt="author-image">
        </div>
        <div class="dz-info">
            <h5 class="name">{{ $anak->nama }}</h5>
            <span class="mail">Bright Star of Child</span>
        </div>
    </a>
    <ul class="nav navbar-nav">
        <li>
            <div class="mode">
                <span class="dz-icon me-2">
                    <i class="icon feather icon-moon"></i>
                </span>
                <span>Dark Mode</span>
                <div class="custom-switch">
                    <input type="checkbox" class="switch-input theme-btn" id="toggle-dark-menu">
                    <label class="custom-switch-label" for="toggle-dark-menu"></label>
                </div>
            </div>
        </li>
        <li>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <span class="dz-icon">
                    <i class="feather icon-log-out"></i>
                </span>
                <span>Logout</span>

            </a>
        </li>
        {{-- <li> <button id="install-btn" class="btn btn-info">
                Install Aplikasi
            </button></li> --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <!-- Modal Konfirmasi Logout -->
        <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="logoutModalLabel">Konfirmasi Logout</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin keluar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="#" class="btn btn-sm btn-danger" id="confirm-logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>


    </ul>
    <div class="sidebar-bottom">
        <div class="app-info">
            <h6 class="name font-w400"><b>Bright Star Of Child</b> </h6>
            <span class="ver-info">App Version 1.0</span>
        </div>
    </div>
</div>
