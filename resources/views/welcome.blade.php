<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPK Seleksi Karyawan - {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
    <header class="p-0 shadow">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
            <a class="navbar-brand fw-bold" href="/">SPK Seleksi Calon Karyawan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link fw-semibold active" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-semibold" href="/seleksi-karyawan">Pemilihan Calon Pegawai</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-semibold" href="/#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-semibold" href="/#kontak">Kontak</a>
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
                    <li><a class="dropdown-item" href="/{{ auth()->user()->level }}/data-karyawan">Data Calon Pegawai</a></li>
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
      <main>
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="{{asset('image/hero.jpg')}}" class="d-block mx-lg-auto img-fluid" alt="<a href='https://www.freepik.com/vectors/candidate'>Candidate vector created by katemangostar - www.freepik.com</a>" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Sistem Pendukung Keputusan Seleksi Calon Keryawan</h1>
                    <p class="lead">Website ini merupakan sebuah sistem pendukung keputusan untuk menyeleksi karyawan bedasarkan algoritma <b>profile matching</b>. Aplikasi ini dibuat untuk memenuhi kebutuhan dan memudahkan suatu instansi dalam menyeleksi calon karyawan baru.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        {{-- <button type="button" class="btn btn-primary btn-lg px-4 me-md-2"></button> --}}
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Lakukan Seleksi</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-4 py-5 mb-5" id="tentang">
            <h2 class="pb-2 border-bottom">Apa saja yang bisa kamu lakukan ?</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
              <div class="col d-flex align-items-start">
                <div class="icon-square bg-light text-dark d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                  {{-- <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg> --}}
                  <i class="bi bi-person-rolodex" style="font-size:1.5em"></i>
                </div>
                <div>
                  <h2>Mengelola data calon karyawan</h2>
                  <p>Pada aplikasi ini kamu dapat mengelola data calon karyawan yang akan masuk, fitur ini masih terbatas akan tetapi bisa dikembangkan.</p>
                </div>
              </div>
              <div class="col d-flex align-items-start">
                <div class="icon-square bg-light text-dark d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                    <i class="bi bi-person-lines-fill" style="font-size:1.5em"></i>
                </div>
                <div>
                  <h2>Melakukan Seleksi Karyawan</h2>
                  <p>Aplikasi ini juga bisa melakukan seleksi calon karyawan menggunakan algoritma profile matching, selain itu juga bisa memodifikasi kriteria kebutuhan.</p>
                </div>
              </div>
              <div class="col d-flex align-items-start">
                <div class="icon-square bg-light text-dark d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                  {{-- <svg class="bi" width="1em" height="1em"><use xlink:href="#tools"/></svg> --}}
                  <i class="bi bi-people-fill" style="font-size: 1.5em"></i>
                </div>
                <div>
                  <h2>Fitur Multi Login</h2>
                  <p>Aplikasi ini memiliki 2 login, yaitu login untuk admin yang mana bertugas input data kebutuhan untuk seleksi serta login pegawai guna input data calon karyawan</p>
                </div>
              </div>
            </div>
          </div>
          <div class="container" id="kontak">
            <h2 class="border-bottom text-center pb-1">Kontak Kami</h2>
            <div class="row justify-content-md-center p-4">
                <div class="col-5 text-center">
                    <h4 class="pb-2">Kamu dapat temukan kami di :</h4>
                    <p style="line-height: 2.4;font-size:1rem">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex sed, est ut deserunt, odio veritatis quae nemo earum, nulla nostrum explicabo excepturi velit corrupti facere officia illo provident qui enim. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis similique perferendis ratione maiores quos assumenda facilis. Temporibus quidem assumenda, repellendus quaerat illo, eum vel ducimus sunt tempora consequuntur sapiente hic?</p>
                </div>
            </div>
          </div>

        </main>
        <div class="container">
          <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
              <span class="text-muted">&copy; 2022 MT Dev</span>
            </div>
          </footer>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>