@extends('layouts.main')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container ps-4 pe-4">
        <h2 class="fw-bold text-center pt-5 pb-4">Tambah Data Nilai Standar</h2>
        <div class="text-end">
            <a href="{{ route('bobot.index') }}" class="btn btn-danger fw-semibold">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali
            </a>
        </div>
        <div class="mt-3">
            <form action="{{ route('bobot.store') }}" method="POST">
                @csrf
                @foreach ($parent as $item)
                <h3 class="fw-semibold">Nilai Ideal Aspek {{ $item->name }}</h3>
                    <div class="row mb-4 mt-3">
                        @foreach ($kriteria as $data)
                            @if ($data->id_parent == $item->id)
                                <div class="col-3">
                                    <input type="hidden" name="{{ $data->name }}_id" value="{{ $data->id }}">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('nilai_ideal') is-invalid @enderror" id="name" name="{{ $data->name }}_nilai" placeholder="Nilai Ideal" value="{{ old('nilai_ideal') }}" required>
                                        <label for="floatingInput">{{ $data->name }}</label>
                                    </div>
                                    @error('nilai_ideal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
                <div class="text-end">
                    <button type="reset" class="btn btn-warning fw-semibold">Reset</button>
                    <button type="submit" class="btn btn-primary fw-semibold">Tambahkan</button>
                </div>
            </form>
        </div>
        {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        </div> --}}
    </div>
  </main>
@endsection