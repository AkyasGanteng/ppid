@extends('layouts.app')

@section('title', 'Edit PDF')

@section('content')
<div class="container mt-5">
    <h2>Edit PDF</h2>
    <form action="{{ route('pdfs.update', $pdf) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Judul PDF</label>
            <input type="text" name="title" class="form-control" value="{{ $pdf->title }}" required>
        </div>
        <div class="mb-3">
            <label>File PDF (Opsional)</label>
            <input type="file" name="file" class="form-control" accept="application/pdf">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
