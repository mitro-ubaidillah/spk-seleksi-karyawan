@auth
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <div class="container">
    <a class="navbar-brand fs-6" href="#">SPK Seleksi Calon Karyawan</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <p class="w-100 bg-dark">
      {{ auth()->user()->name }}
    </p> --}}
    <input class="form-control form-control-dark w-100 bg-dark rounded-0 border-0 right" type="text" placeholder="Selamat datang, {{ auth()->user()->name }}" disabled>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        {{-- <a class="nav-link px-3" href="#">Sign out</a> --}}
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="logout-link">Logout</button>
        </form>
      </div>
    </div>
  </div>
</header>
@else
<header class="p-0 shadow">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">SPK Seleksi Calon Karyawan</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="#">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="#">Pemilihan Calon Pegawai</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="#">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="#">Kontak</a>
          </li>
        </ul>
        <div class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle link-admin" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Selamat datang, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/{{ auth()->user()->level }}">Dashboard</a></li>
              <li><a class="dropdown-item" href="/{{ auth()->user()->level }}/kriteria">Data Kriteria</a></li>
              <li><a class="dropdown-item" href="/{{ auth()->user()->level }}/bobot">Data Bobot</a></li>
              {{-- <li><a class="dropdown-item" href="/{{ auth()->user->level }}">Daftar CF User</a></li> --}}
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li>
            <a href="/login" class="login-link">Login</a>
          </li>
        @endauth
        </div>
      </div>
    </div>
  </nav>
</header>
@endauth