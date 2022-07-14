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
            <form action="{{ route('data-karyawan.update',$dataKaryawan->id) }}" id="form-seleksi" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Calon Karyawan" value="{{ old('name', $dataKaryawan->karyawan->name) }}" required>
                            <label for="floatingInput">Nama Karyawan</label>
                        </div>
                        @error('name')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" placeholder="Tanggal Lahir" value="{{ old('tgl_lahir',$dataKaryawan->karyawan->tgl_lahir) }}" required>
                            <label for="floatingInput">Tanggal Lahir</label>
                        </div>
                        @error('tgl_lahir')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat" value="{{ old('alamat',$dataKaryawan->karyawan->alamat) }}" required>
                            <label for="floatingInput">Alamat</label>
                        </div>
                        @error('alamat')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @foreach ($kriteria as $item)
                        @if (count($kriteria) > 2)
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('{{ str_replace(" ", "_",$item->name)}}') is-invalid @enderror" id="name" name="{{ str_replace(" ", "_",$item->name)}}" placeholder="Nilai Kriteria {{ $item->name }}" value="{{ old(str_replace(" ", "_",$item->name),$nilai[$i++])}}" required>
                                    <label for="floatingInput">Nilai Kriteria {{ $item->name }}</label>
                                </div>
                                @error('{{ str_replace(" ", "_",$item->name)}}')
                                    <div class="is-invalid">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @else
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('{{ str_replace(" ", "_",$item->name)}}') is-invalid @enderror" id="name" name="{{ str_replace(" ", "_",$item->name)}}" placeholder="Nilai Kriteria {{ $item->name }}" value="{{ old(str_replace(" ", "_",$item->name),$nilai[$i++])}}" required>
                                    <label for="floatingInput">Nilai Kriteria {{ $item->name }}</label>
                                </div>
                                @error('{{ str_replace(" ", "_",$item->name)}}')
                                    <div class="is-invalid">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="col-md-3 col-3">
                            <a href="{{ route('data-karyawan.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                        <div class="text-end col-md-9 col-9">
                            <button type="submit" class="btn btn-primary fw-semibold">Ubah Data</button>
                            <button type="reset" class="btn btn-warning fw-semibold">Reset Data</button>
                        </div>
                    </div>
                </div>
                </form>
         </div>
    </main>
@endsection