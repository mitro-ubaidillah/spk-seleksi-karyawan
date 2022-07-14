@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row">
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container ps-4 pe-4">
          @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <div class="container">
            <div class="row">
              <div class="col-12">
                <h2 class="fw-bold mt-3 mb-3 text-center">Halaman Admin</h2>
              </div>
              <div class="col-12 text-center">
                <img src="{{ asset('image/background.jpg') }}" alt="" class="img-admin">
              </div>
              <div class="col-12 text-center">
                <a href="/seleksi-karyawan" class="btn btn-primary fw-bold">Lakukan Seleksi Karyawan</a>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
</div>
@endsection