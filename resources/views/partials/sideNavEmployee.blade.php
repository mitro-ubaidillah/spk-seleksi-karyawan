<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-5">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ $title == 'pegawai' ? 'active' : '' }}" aria-current="page" href="/pegawai">
            <i class="bi bi-house-door-fill align-text-bottom"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $title == 'kriteria' ? 'active' : '' }}" href="/pegawai/kriteria">
            <i class="bi bi-card-list align-text-bottom"></i>
            Data Kriteria
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $title == 'Nilai Standar' ? 'active' : '' }}" href="/pegawai/bobot">
            <i class="bi bi-list-ol align-text-bottom"></i>
            Data Bobot
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $title == 'Data Karyawan' ? 'active' : '' }}" href="{{ route('data-karyawan.index') }}">
            <i class="bi bi-person-plus-fill align-text-bottom"></i>
            Data Calon Pegawai
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $title == 'Seleksi Calon Pegawai' ? 'active' : '' }}" href="/seleksi-karyawan">
            <i class="bi bi-person-lines-fill align-text-bottom"></i>
            Seleksi Calon Pegawai
          </a>
        </li>
      </ul>
    </div>
  </nav>