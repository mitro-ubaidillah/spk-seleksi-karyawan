@extends('layouts.main')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 mb-5">
        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
         <div class="container">
            <h2 class="text-center fw-semibold">Halaman Seleksi Calon Karyawan</h2>
            <form class="mt-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" disabled class="form-control" id="name" name="name" placeholder="Nama Calon Karyawan" value="{{ old('name', $dataKaryawan->karyawan->name) }}" required>
                            <label for="floatingInput">Nama Karyawan</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" disabled class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir" value="{{ old('tgl_lahir',$dataKaryawan->karyawan->tgl_lahir) }}" required>
                            <label for="floatingInput">Tanggal Lahir</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" disabled class="form-control" name="alamat" placeholder="Alamat" value="{{ old('alamat',$dataKaryawan->karyawan->alamat) }}" required>
                            <label for="floatingInput">Alamat</label>
                        </div>
                    </div>
                    @foreach ($kriteria as $item)
                        @if (count($kriteria) > 2)
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="text" disabled class="form-control" id="name" name="{{ str_replace(" ", "_",$item->name)}}" placeholder="Nilai Kriteria {{ $item->name }}" value="{{ old(str_replace(" ", "_",$item->name),$nilai[$i++])}}" required>
                                    <label for="floatingInput">Nilai Kriteria {{ $item->name }}</label>
                                </div>
                            </div>
                        @else
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" disabled class="form-control" id="name" name="{{ str_replace(" ", "_",$item->name)}}" placeholder="Nilai Kriteria {{ $item->name }}" value="{{ old(str_replace(" ", "_",$item->name),$nilai[$i++])}}" required>
                                    <label for="floatingInput">Nilai Kriteria {{ $item->name }}</label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="col-md-9 col-9">
                            <a href="{{ route('data-karyawan.index') }}" class="btn btn-danger">Kembali Ke Halaman Data Pegawai</a>
                            <a href="/seleksi-karyawan" class="btn btn-danger">Kembali Ke Halaman Seleksi Calon Pegawai</a>
                        </div>
                        <div class="text-end col-md-3 col-3">
                            <a href="{{ route('data-karyawan.edit',$dataKaryawan->id) }}" class="btn btn-primary fw-semibold">Edit Data</a>
                        </div>
                    </div>
                </div>
                </form>
         </div>
    </main>
@endsection