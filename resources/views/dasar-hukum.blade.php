@extends('layouts.app')

@section('title', 'Dasar Hukum')

@section('content')
<div class="container mt-5">
    <h1 class="text-center fw-bold text-white py-3" style="background-color: #001f54;">Dasar Hukum PPID</h1>

    @php
        $grouped = $items->groupBy('kategori');
    @endphp

    @foreach ($grouped as $kategori => $group)
    <div class="mt-5">
        <h5 class="fw-bold text-dark">{{ $kategori }} ({{ $group->count() }})</h5>

        @foreach ($group as $item)
            <div class="d-flex justify-content-between border-bottom py-2 align-items-center">
                <div>
                    <span>- {{ $item->title }}</span>
                </div>
                <div>
                    <a href="{{ asset('storage/' . $item->file) }}" class="text-danger fw-bold" target="_blank">Download</a>
                </div>
            </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection
