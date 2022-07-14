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
    <h2 class="fw-bold text-center pt-5 pb-4">Hasil Seleksi Calon Karyawan</h2>
    <div class="text-end">
        <a href="/seleksi-karyawan/proses/cetak" target="_blank" class="btn btn-primary">Cetak PDF</a>
    </div>
    <div class="mb-3 mt-3">
      <table class="table table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>TGL Lahir</th>
            <th>Alamat</th>
            <th>Nilai Total</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($rangking as $key => $data)
            @foreach ($dataKaryawan as $karyawan)
            <tr>
                @if ($karyawan->name == $key)
                    <td>{{ ++$no }}</td>
                    <td>{{ $karyawan->name }}</td>
                    <td>{{ $karyawan->tgl_lahir }}</td>
                    <td>{{ $karyawan->alamat }}</td>
                    <td>{{ $data[0] }}</td>
                @endif
            </tr>
            @endforeach
        @endforeach
        </tbody>
      </table> 
      <a href="/seleksi-karyawan/hapus-semua" class="btn btn-danger">Selesai dan Hapus Data</a>
    </div>
  </div>
</main>
@endsection