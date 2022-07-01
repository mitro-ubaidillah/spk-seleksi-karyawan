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
          @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <h2 class="fw-bold text-center pt-5 pb-4">Daftar Data Kriteria</h2>
          <div class="dropdown text-end">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Tambah Data Baru
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('kriteria.create') }}">Data Kriteria</a></li>
                <li><a class="dropdown-item" href="{{ route('kriteria-parent.index') }}">Data Aspek Kriteria</a></li>
              </ul>
          </div>
          <div class="mb-3 mt-3">
            <table class="table table-bordered">
              <thead class="table-dark">
                <tr>
                  <th>No</th>
                  <th>Kriteria</th>
                  <th>Aspek</th>
                  <th>Kelompok</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($kriteria as $data)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->kriteriaParent->name }}</td>
                    <td>{{ $data->kelompok }}</td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda yakin akan menghapus data ini ?');" action="{{ route('kriteria.destroy', $data->id) }}" method="POST">
                            <a href="{{route('kriteria.edit', $data->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
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
            <div class="clear"></div>
            {{ $kriteria->links() }}
          </div>
        </div>
      </main>
    </div>
</div>
@endsection