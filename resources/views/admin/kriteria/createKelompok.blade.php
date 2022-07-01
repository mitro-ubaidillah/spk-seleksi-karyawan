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
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container ps-4 pe-4">
            <h2 class="fw-bold text-center pt-5 pb-4">Data Golongan Kriteria</h2>
            <div class="text-end">
                <a href="{{ route('kriteria.index') }}" class="btn btn-danger fw-semibold">
                    <i class="bi bi-arrow-left-circle"></i>
                    Kembali
                </a>
            </div>
            <div class="mt-3 mb-5">
                <form action="{{ route('kriteria-parent.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Kriteria">
                        <label for="name">Nama Golongan Kriteria</label>
                      </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
            <div class="mt-3 mb-5">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                      <tr>
                        <th>No</th>
                        <th>Golongan / Aspek</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse($parents as $parent)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $parent['name'] }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda yakin akan menghapus data ini ?')" action="{{ route('kriteria-parent.destroy', $parent->id) }}" method="POST">
                                        <a href="{{ route('kriteria-parent.edit', $parent->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                          <td colspan="5">
                            <div class="alert alert-danger">
                                Data Gejala belum Tersedia
                            </div>
                          </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
      </main>
    </div>
</div>
@endsection