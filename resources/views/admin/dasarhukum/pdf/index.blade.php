@extends('layouts.app')

@section('title', 'Manajemen PDF')

@section('content')
<div class="container mt-5">
    <h2>Daftar PDF</h2>
    <a href="{{ route('pdfs.create') }}" class="btn btn-primary mb-3">Tambah PDF</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pdfs as $pdf)
            <tr>
                <td>{{ $pdf->title }}</td>
                <td><a href="{{ asset('storage/' . $pdf->file) }}" target="_blank">Lihat PDF</a></td>
                <td>
                    <a href="{{ route('pdfs.edit', $pdf) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pdfs.destroy', $pdf) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
