@extends('layouts.app')

@section('title', 'Tambah PDF')

@section('content')
<div class="container mt-5">
    <h2>Tambah PDF</h2>
    <form action="{{ route('pdfs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Judul PDF</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>File PDF</label>
            <input type="file" name="file" class="form-control" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
