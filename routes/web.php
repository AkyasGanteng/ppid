<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\DasarHukumController;
use App\Http\Controllers\GaleriController;
use App\Models\DasarHukum;

// ===============================
// HALAMAN UTAMA (PUBLIK)
Route::get('/', [BeritaController::class, 'beranda'])->name('home');

Route::get('/profil-ppid', function () {
    return view('proppid');
})->name('profil.ppid');

// ===============================
// AUTH: LOGIN & REGISTER (HANYA UNTUK TAMU)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ===============================
// LOGOUT (HANYA UNTUK YANG SUDAH LOGIN)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ===============================
// HALAMAN YANG HANYA BISA DIAKSES SETELAH LOGIN
Route::middleware('auth')->group(function () {
    // Halaman dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

   

    Route::get('/pendaftaran', function () {
        return view('pendaftaran');
    })->name('pendaftaran');

    // CRUD PDF
    Route::resource('pdfs', PdfController::class);
    Route::resource('dasarhukum', DasarHukumController::class);
   
    // CRUD GALERI

    Route::resource('galeri', GaleriController::class);
});

// ===============================
// HALAMAN PUBLIK LAINNYA
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

Route::get('/sop-ppid', function () {
    return view('sop-ppid');
})->name('sop-ppid');

Route::get('/maklumat-layanan', function () {
    return view('maklumat-layanan');
})->name('maklumat-layanan');

Route::get('/bagan', function () {
    return view('bagan');
})->name('bagan');

Route::get('/ppid-pembantu', function () {
    return view('ppid-pembantu');
})->name('ppid-pembantu');

Route::get('/visimisi', function () {
    return view('visimisi');
})->name('visimisi');

Route::get('/dasar-hukum', function () {
    $items = DasarHukum::all();
    return view('dasar-hukum', compact('items'));
})->name('dasar-hukum');
Route::resource('galeri', GaleriController::class)->only(['index', 'show']);
// Tampilkan form lupa password
Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgotForm'])->name('password.request');

// Proses kirim email reset
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Form reset password dengan token
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Proses update password
Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
 // CRUD Berita
 Route::resource('berita', BeritaController::class)->parameters([
    'berita' => 'berita'
]);
