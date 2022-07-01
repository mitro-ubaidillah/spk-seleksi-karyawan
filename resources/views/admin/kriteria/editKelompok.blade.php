@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-5">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/admin">
                <i class="bi bi-house-door-fill align-text-bottom"></i>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('kriteria.index') }}">
                <i class="bi bi-card-list align-text-bottom"></i>
                Data Kriteria
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-list-ol align-text-bottom"></i>
                Data Bobot
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-person-lines-fill align-text-bottom"></i>
                Seleksi Calon Pegawai
              </a>
            </li>
          </ul>
        </div>
      </nav>
  
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container ps-4 pe-4">
            <h2 class="fw-bold text-center pt-5 pb-4">Edit Data Aspek Kriteria</h2>
            <div class="text-end">
                <a href="{{ route('kriteria-parent.index') }}" class="btn btn-danger fw-semibold">
                    <i class="bi bi-arrow-left-circle"></i>
                    Kembali
                </a>
            </div>
            <div class="mt-3 mb-5">
                <form action="{{ route('kriteria-parent.update', $parent->id) }}" method="POST" nonvalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $parent->name) }}">
                        <label for="name">Nama Aspek Kriteria</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="{{ route('kriteria-parent.index') }}" class="btn btn-danger">Batal</a>
                </form>
            </div>
        </div>
      </main>
    </div>
</div>
@endsection