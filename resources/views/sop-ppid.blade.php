@extends('layouts.app')

@section('title', 'SOP PPID')

@section('content')
<div class="container mt-5">
    <h1 class="text-center fw-bold mb-3">Standar Operasional Prosedur PPID</h1>
    <p class="text-center text-secondary mb-5">Berikut adalah daftar SOP PPID yang dapat diunduh.</p>

    <div class="row">
        <!-- Kolom SOP -->
        <div class="col-lg-8">
            <div class="row">
                @foreach(\App\Models\Pdf::all() as $index => $pdf)
                <div class="col-md-6 mb-4">
                    <div class="border rounded-3 shadow-sm p-3 position-relative" style="transition: 0.3s;">
                        <small class="text-muted d-block mb-2">{{ \Carbon\Carbon::parse($pdf->created_at)->translatedFormat('l, d F Y') }}</small>
                        <h6 class="fw-semibold mb-2">
                            {{ $index + 1 }}. <a href="{{ asset('storage/' . $pdf->file) }}" target="_blank" class="text-decoration-none text-dark">{{ $pdf->title }}</a>
                        </h6>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Kolom Berita -->
        <div class="col-lg-4">
            <h5 class="border-bottom border-3 border-warning pb-2 mb-4 fw-bold text-dark">Berita PPID</h5>
            @foreach(\App\Models\Berita::latest()->take(5)->get() as $berita)
            <div class="d-flex mb-4">
                <img src="{{ asset('storage/' . $berita->foto) }}" alt="gambar" style="width: 100px; height: 70px; object-fit: cover;" class="rounded-2 me-3">
                <div>
                    <small class="text-muted d-block mb-1">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d M Y H:i') }}</small>
                    <a href="{{ route('berita.show', $berita->id) }}" class="text-dark fw-semibold text-decoration-none">
                        {{ Str::limit($berita->judul, 60) }}
                    </a>
                    <p class="mb-0 text-muted small">{{ Str::limit($berita->deskripsi, 80) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
