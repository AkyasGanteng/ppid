@extends('layouts.app')

@section('title', 'Tambah Dasar Hukum')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 fw-bold">Tambah Dasar Hukum</h1>

    <form action="{{ route('dasarhukum.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <h2 class="form-label">Judul</h2>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <h2 class="form-label">Upload PDF</h2>
            <input type="file" name="file" class="form-control" accept="application/pdf" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
