@extends('layouts.main')
@section('content')
< <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="alokasi" name="alokasi" placeholder="Masukan Alokasi Nilai">
                    <label for="name">Masukan Alokasi Nilai</label>
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
                  <th>Alokasi/Kebutuhan (%)</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                  @forelse($parents as $parent)
                      <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $parent->name }}</td>
                          <td>{{ $parent->alokasi }}%</td>
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
@endsection