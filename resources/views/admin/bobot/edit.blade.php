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
            <form action="{{ route('bobot.update', $bobot->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('nilai_ideal') is-invalid @enderror" id="name" name="nilai_ideal" placeholder="Nilai Ideal" value="{{ old('nilai_ideal', $bobot->nilai_ideal) }}" required>
                    <label for="floatingInput">Nilai Ideal</label>
                </div>
                @error('nilai_ideal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-floating mb-3">
                    <select class="form-select @error('kriteria_id') is-invalid @enderror" id="floatingSelect" aria-label="Floating label select example" name="kriteria_id" required>
                        @foreach ($kriteria as $data)
                            @if (old('kriteria_id', $bobot->kriteria_id) == $data->id)
                                <option value="{{ $data->id }}" selected>{{ $data->name }}</option>
                            @else
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="floatingSelect">Kriteria</label>
                </div>
                @error('kriteria_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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