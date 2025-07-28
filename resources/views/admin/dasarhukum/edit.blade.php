@extends('layouts.app')

@section('title', 'Edit Dasar Hukum')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 fw-bold">Edit Dasar Hukum</h1>

    <form action="{{ route('dasarhukum.update', $dasarhukum->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <h2 class="form-label">Judul</h2>
            <input type="text" name="title" value="{{ $dasarhukum->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <h2 class="form-label">Upload PDF</h2>
            <input type="file" name="file" class="form-control" accept="application/pdf">
            <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $dasarhukum->file) }}" target="_blank">Lihat</a></small>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
