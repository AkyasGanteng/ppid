@extends('layouts.app')

@section('title', 'Kelola Dasar Hukum')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 fw-bold">Data Dasar Hukum</h1>
    <a href="{{ route('dasarhukum.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Judul</th>
                <th>PDF</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td><a href="{{ asset('storage/' . $item->file) }}" target="_blank">Lihat PDF</a></td>
                <td>
                    <a href="{{ route('dasarhukum.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('dasarhukum.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
