@extends('layouts.main')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container ps-4 pe-4">
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <h2 class="fw-bold text-center pt-5 pb-4">Daftar Data Kriteria</h2>
    <div class="text-end">
        <a class="btn btn-primary" href="{{ route('data-karyawan.create') }}">Masukan Data Karyawan</a>
    </div>
    <div class="mb-3 mt-3">
      <table class="table table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>TGL Lahir</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($dataKaryawan as $data)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $data->karyawan->name }}</td>
                <td>{{ $data->karyawan->tgl_lahir }}</td>
                <td>{{ $data->karyawan->alamat }}</td>
                <td class="text-center">
                  <form onsubmit="return confirm('Apakah Anda yakin akan menghapus data ini ?');" action="{{ route('data-karyawan.destroy', $data->id) }}" method="POST">
                      <a href="{{route('data-karyawan.edit', $data->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
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
                    Data Karyawan belum Tersedia
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table> 
      <div class="clear"></div>
      {{ $dataKaryawan->links() }}
      <div class="text-start">
        <a href="/karyawan/hapus-semua" class="btn btn-danger">Hapus Semua Data Karyawan</a>
      </div>
    </div>
  </div>
</main>
@endsection