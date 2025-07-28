@extends('layouts.app')

@section('title', 'Pendaftaran')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Formulir Pendaftaran</h1>

    @auth
        <p>Selamat datang, {{ Auth::user()->name }}! Silakan isi formulir berikut.</p>

        <!-- FORM PENDAFTARAN -->
        <form action="#" method="POST">
            @csrf
            <!-- contoh isian form -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Aktif</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    @else
        <div class="alert alert-warning">
            Anda harus <a href="{{ route('login') }}">login terlebih dahulu</a> untuk mengakses formulir pendaftaran.
        </div>
    @endauth
</div>
@endsection
