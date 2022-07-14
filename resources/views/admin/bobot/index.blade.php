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
        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h2 class="fw-bold text-center pt-5 pb-4">Daftar Data Nilai Standar</h2>
        <div class="text-end">
            <a class="btn btn-primary fw-semibold" href="{{ route('bobot.create') }}"><i class="bi bi-plus-circle"></i> Tambah Nilai Standar Kriteria</a>
        </div>
        <div class="mb-3 mt-3">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Nilai Standar</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($bobot as $data)
                <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->kriteria->name }}</td>
                <td>{{ $data->nilai_ideal }}</td>
                <td class="text-center">
                    <form onsubmit="return confirm('Apakah Anda yakin akan menghapus data ini ?');" action="{{ route('bobot.destroy', $data->id) }}" method="POST">
                        <a href="{{route('bobot.edit', $data->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
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
                        Data Bobot belum Tersedia
                    </div>
                </td>
                </tr>
            @endforelse
            </tbody>
        </table>  
        <div class="clear"></div>
        {{ $bobot->links() }}
        </div>
    </div>
</main>
@endsection