<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light py-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="mdi mdi-bullseye mdi-36px"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav_lc"
                aria-controls="nav_lc" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav_lc">
                <ul
                    class="d-none d-lg-flex navbar-nav mx-auto my-3 my-lg-0 position-absolute top-50 start-50 translate-middle">
                    <li class="nav-item me-4"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="{{ route('catalog.index') }}">Katalog Buku</a>
                    </li>
                </ul>
                <ul class="navbar-nav my-3 my-lg-0 d-lg-none">
                    <li class="nav-item me-4"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="{{ route('catalog.index') }}">Katalog Buku</a>
                    </li>
                </ul>
                <div class="ms-lg-auto">
                    @auth
                        @if (auth()->user()->role == 'Anggota')
                            <a class="btn btn-outline-primary me-2" href="{{ route('catalog.history') }}">Riwayat</a>
                        @else
                            <a class="btn btn-outline-primary me-2" href="/home">Dashboard</a>
                        @endif
                    @else
                        <a class="btn btn-outline-primary me-2" href="/login">Login</a>
                        <a class="btn btn-primary" href="/register">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</div>
