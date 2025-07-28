<div class="menubar-area footer-fixed">
    <div class="toolbar-inner menubar-nav">
        <a href="{{ route('mobile.payment') }}" class="nav-link @yield('mobilePayment')">
            <i class="fi fi-rr-credit-card"></i>
        </a>
        <a href="{{ route('mobile.result') }}" class="nav-link @yield('mobileResult')">
            <i class="fi fi-rr-document"></i>
        </a>
        <a href="{{ route('app') }}" class="nav-link @yield('mobileDashboard')">
            <i class="fi fi-rr-home"></i>
        </a>
        <a href="{{ route('mobile.kunjungan') }}" class="nav-link @yield('mobileTerapi')">
            <i class="fi  fi-rr-document-signed"></i>
        </a>
        <a href="{{ route('mobile.profile') }}" class="nav-link @yield('mobileProfile')">
            <i class="fi fi-rr-user"></i>
        </a>
    </div>
</div>
