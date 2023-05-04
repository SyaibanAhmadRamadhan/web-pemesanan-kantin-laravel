<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-5">
        <img src="{{ asset('assets/img/logo1.png') }}" height="30" alt="" />
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item my-2 mx-3 dropdown">
                    <a class="nav-link dropdown-toggle active" aria-current="page" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"> Menu </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('menu.view') }}">Menu Makanan</a></li>
                        @if (isset(Auth()->user()->role))
                            @if (Auth()->user()->role == 'pembeli')
                                <li><a class="dropdown-item" href="{{ route('list.pesanan.view') }}">Pesanan Pembeli</a>
                                </li>
                            @elseif(Auth()->user()->role == 'penjual')
                                <li><a class="dropdown-item" href="#">Pesanan Pembeli</a></li>
                            @endif
                        @endif
                    </ul>
                </li>

                @if (Auth()->user())
                    <li class="nav-item my-2 mx-3 dropdown">
                        <a class="nav-link dropdown-toggle bg-white rounded-pill text-dark px-3 text-center shadow-primary"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/img/profile.svg') }}" class="img-profile rounded-circle me-1"
                                alt="" />
                            {{ Auth()->user()->username }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.view') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @elseif($title == 'login')
                    <li class="nav-item my-2 mx-3 dropdown">
                        <a class="nav-link bg-white rounded-pill text-dark px-3 text-center shadow-primary"
                            href="{{ route('register.view') }}">
                            <img src="{{ asset('assets/img/profile.svg') }}" class="img-profile rounded-circle me-1"
                                alt="" />
                            Sign Up
                        </a>
                    </li>
                @elseif($title == 'register')
                    <li class="nav-item my-2 mx-3 dropdown">
                        <a class="nav-link bg-white rounded-pill text-dark px-3 text-center shadow-primary"
                            href="{{ route('login.view') }}">
                            <img src="{{ asset('assets/img/profile.svg') }}" class="img-profile rounded-circle me-1"
                                alt="" />
                            Sign In
                        </a>
                    </li>
                @else
                    <li class="nav-item my-2 mx-3 dropdown">
                        <a class="nav-link bg-white rounded-pill text-dark px-3 text-center shadow-primary"
                            href="{{ route('login.view') }}">
                            <img src="{{ asset('assets/img/profile.svg') }}" class="img-profile rounded-circle me-1"
                                alt="" />
                            Sign In
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
