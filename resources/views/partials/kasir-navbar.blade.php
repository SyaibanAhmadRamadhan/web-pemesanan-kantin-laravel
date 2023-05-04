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
                    <a class="nav-link dropdown-toggle bg-white rounded-pill text-dark px-3 text-center shadow-primary"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/img/profile.svg') }}" class="img-profile rounded-circle me-1"
                            alt="" />
                        {{ Auth()->user()->username }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
