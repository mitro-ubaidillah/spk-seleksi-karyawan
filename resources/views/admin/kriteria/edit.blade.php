@extends('layouts.main')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container ps-4 pe-4">
      <h2 class="fw-bold text-center pt-5 pb-4">Tambah Data Kriteria</h2>
      <div class="text-end">
          <a href="{{ route('kriteria.index') }}" class="btn btn-danger fw-semibold">
              <i class="bi bi-arrow-left-circle"></i>
              Kembali
          </a>
      </div>
      <div class="mt-3">
        <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Kriteria" value="{{ old('name', $kriteria->name) }}" required>
            <label for="floatingInput">Nama Kriteria</label>
          </div>
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
          <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="id_parent" required>
              @foreach ($parents as $parent)
                  <option value="{{ $parent->id }}" {{ old('kelompok',$kriteria->id_parent) == $parent->id  ? 'selected' : '' }}>{{ $parent->name }}</option>
              @endforeach
            </select>
            <label for="floatingSelect">Aspek</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="kelompok" required>
              <option value="utama" {{ old('kelompok',$kriteria->kelompok) == "utama" ? 'selected' : '' }}>Utama</option>
              <option value="sekunder" {{ old('kelompok',$kriteria->kelompok) == "sekunder" ? 'selected' : '' }}>Sekunder</option>
            </select>
            <label for="floatingSelect">Kelompok</label>
          </div>
          <div class="text-end">
            <button type="reset" class="btn btn-warning fw-semibold">Reset</button>
            <button type="submit" class="btn btn-primary fw-semibold">Ubah</button>
          </div>
        </form>
      </div>
      {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div> --}}
  </div>
</main>
@endsection