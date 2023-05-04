<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/logo1.png') }}">
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item @if ($title == 'dashboard') active @endif">
        <a class="nav-link" href="{{ route('dashboard.view') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item @if ($title == 'data-menu' || $title == 'tambah-menu') active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fas fa-fw fa-utensils"></i>
            <span>Menu</span>
        </a>
        <div id="collapseBootstrap" class="collapse @if ($title == 'data-menu' || $title == 'tambah-menu') show @endif"
            aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item @if ($title == 'data-menu') active @endif"
                    href="{{ route('menu.data.view') }}">Data Menu</a>
                <a class="collapse-item @if ($title == 'tambah-menu') active @endif"
                    href="{{ route('menu.add.view') }}">Tambah Menu</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if ($title == 'pesanan') active @endif">
        <a class="nav-link" href="{{ route('penjual.pesanan.view') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Pesanan</span>
        </a>
    </li>
    <hr class="sidebar-divider">
</ul>
