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
    <h2 class="fw-bold text-center pt-5 pb-4">Daftar Calon Pegawai</h2>
    <table class="table table-bordered text-center">
      <thead>
        <tr>
            <th colspan="{{ count($dataKriteria) }}">Data Aspek Penilaian</th>
        </tr>
        <tr>
            @foreach ($dataKriteria as $kriteria)
                <th>{{ $kriteria->name }}</th>
            @endforeach
        </tr>
      </thead>
      <tbody>
        <tr>
            @foreach ($dataKriteria as $kriteria)
              <th>A{{ $kriteria->id }}</th>
            @endforeach
        </tr>
      </tbody>
    </table> 
    <div class="mb-3 mt-3">
      <table class="table table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            @foreach ($dataKriteria as $kriteria)
                <th>A {{ $kriteria->id}}</th>
            @endforeach
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($dataKaryawan as $data)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $data->karyawan->name }}</td>
                @php
                    $nilaiKaryawan = explode(",", $data->nilai);
                @endphp
                @for ($i = 0; $i < count($nilaiKaryawan); $i++)
                    <td>{{ $nilaiKaryawan[$i] }}</td>
                @endfor
                <td class="text-center">
                    <a href="{{route('data-karyawan.show', $data->id)}}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="{{ count($dataKriteria)+3}}">
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
        <a href="/seleksi-karyawan/proses" class="btn btn-success">Seleksi Karyawan</a>
      </div>
    </div>
  </div>
</main>
@endsection