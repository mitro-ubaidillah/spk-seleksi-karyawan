@extends('layouts.main')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container ps-4 pe-4">
        <h2 class="fw-bold text-center pt-5 pb-4">Edit Data Aspek Kriteria</h2>
        <div class="text-end">
            <a href="{{ route('kriteria-parent.index') }}" class="btn btn-danger fw-semibold">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali
            </a>
        </div>
        <div class="mt-3 mb-5">
            <form action="{{ route('kriteria-parent.update', $parent->id) }}" method="POST" nonvalidate>
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $parent->name) }}">
                    <label for="name">Nama Aspek Kriteria</label>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{ route('kriteria-parent.index') }}" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>
  </main>
@endsection