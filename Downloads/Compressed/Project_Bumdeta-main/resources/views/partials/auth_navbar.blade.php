<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="/home" class="navbar brand">
            <img src="{{ asset('img/logo.svg') }}" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="/home" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="/desa" class="nav-link">Desa</a>
                </li>
                <li class="nav-item">
                    <a href="/produk" class="nav-link">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="/mitra" class="nav-link">Mitra</a>
                </li>
                <li class="nav-item">
                    <a href="/artikel" class="nav-link">Artikel</a>
                </li>
                <li class="nav-item">
                    <a href="/tentang_kami" class="nav-link">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown" style="width: 40px; height:40px">
                        <img src="{{asset("img/Search.svg")}}" alt=""/>
                    </a>
                </li>
                <li class="nav-item active">
                    @auth
                    <a href="{{route("logout")}}" class="btn btn-success nav-link px-4 text-white">Log Out</a>
                    @endauth
                    @guest
                    <a href="{{route("login")}}" class="btn btn-success nav-link px-4 text-white">Log In</a>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
