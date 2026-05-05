<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog', [KatalogController::class, 'index'])->name('buku.katalog');
Route::get('/buku/detail/{id}', [BukuController::class, 'show'])->name('buku.show');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role == 'admin') {
        return redirect('/admin');
    } elseif ($user->role == 'dosen') {
        return redirect('/dosen');
    } else {
        return redirect('/mahasiswa');
    }
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| DOSEN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('dosen')->group(function () {
    Route::get('/', [PeminjamanController::class, 'dashboardDosen'])
        ->name('dosen.dashboard');
});

/*
|--------------------------------------------------------------------------
| MAHASISWA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('mahasiswa')->group(function () {
    Route::get('/', [PeminjamanController::class, 'dashboardMahasiswa'])
        ->name('mahasiswa.dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN (INI YANG SUDAH FIX)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // ================= PEMINJAMAN =================
    Route::get('/peminjaman', [PeminjamanController::class, 'adminIndex'])
        ->name('admin.peminjaman.index');

    Route::post('/ambil/{id}', [PeminjamanController::class, 'ambilBuku'])
        ->name('admin.ambil');

    // 🔥 PINJAM MANUAL (WAJIB)
    Route::post('/peminjaman/manual', [PeminjamanController::class, 'pinjamManual'])
        ->name('admin.peminjaman.manual');

    Route::get('/peminjaman/hasil/{id}', [PeminjamanController::class, 'hasil'])
        ->name('admin.peminjaman.hasil');

    // ================= PENGEMBALIAN =================
    Route::get('/pengembalian', [PengembalianController::class, 'index'])
        ->name('admin.pengembalian.index');

    Route::post('/pengembalian/{id}', [PengembalianController::class, 'kembali'])
        ->name('admin.peminjaman.kembali');

    // ================= LAPORAN =================
    Route::get('/laporan', [AdminController::class, 'laporan'])
        ->name('admin.laporan.index');

    Route::post('/laporan/filter', [AdminController::class, 'laporanFilter'])
        ->name('admin.laporan.filter');

    // ================= DOSEN =================
    Route::get('/dosen', [AdminController::class, 'dosenIndex'])->name('admin.dosen.index');
    Route::get('/dosen/create', [AdminController::class, 'dosenCreate'])->name('admin.dosen.create');
    Route::post('/dosen', [AdminController::class, 'dosenStore'])->name('admin.dosen.store');
    Route::get('/dosen/{id}/edit', [AdminController::class, 'dosenEdit'])->name('admin.dosen.edit');
    Route::put('/dosen/{id}', [AdminController::class, 'dosenUpdate'])->name('admin.dosen.update');
    Route::delete('/dosen/{id}', [AdminController::class, 'dosenDestroy'])->name('admin.dosen.destroy');

    // ================= MAHASISWA =================
    Route::get('/mahasiswa', [AdminController::class, 'mahasiswaIndex'])->name('admin.mahasiswa.index');
    Route::get('/mahasiswa/create', [AdminController::class, 'mahasiswaCreate'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa', [AdminController::class, 'mahasiswaStore'])->name('admin.mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [AdminController::class, 'mahasiswaEdit'])->name('admin.mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [AdminController::class, 'mahasiswaUpdate'])->name('admin.mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [AdminController::class, 'mahasiswaDestroy'])->name('admin.mahasiswa.destroy');

    // ================= BUKU =================
    Route::get('/buku', [AdminController::class, 'bukuIndex'])->name('admin.buku.index');
    Route::get('/buku/create', [AdminController::class, 'bukuCreate'])->name('admin.buku.create');
    Route::post('/buku', [AdminController::class, 'bukuStore'])->name('admin.buku.store');
    Route::get('/buku/{id}/edit', [AdminController::class, 'bukuEdit'])->name('admin.buku.edit');
    Route::put('/buku/{id}', [AdminController::class, 'bukuUpdate'])->name('admin.buku.update');
    Route::delete('/buku/{id}', [AdminController::class, 'bukuDestroy'])->name('admin.buku.destroy');
});

/*
|--------------------------------------------------------------------------
| OPERATOR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('operator')->group(function () {
    Route::get('/', [OperatorController::class, 'dashboard'])->name('operator.dashboard');
});

/*
|--------------------------------------------------------------------------
| USER (PINJAM + DENDA)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    Route::get('/booking/{id}', [PeminjamanController::class, 'formBooking'])
        ->name('booking.form');

    Route::post('/booking/{id}', [PeminjamanController::class, 'prosesBooking'])
        ->name('booking.proses');

    // ================= DENDA =================
    Route::get('/denda', [DendaController::class, 'index'])
        ->name('denda.index');

    Route::get('/denda/{id}', [DendaController::class, 'detail'])
        ->name('denda.detail');

    Route::get('/denda/{id}/bayar', [DendaController::class, 'bayar'])
        ->name('denda.bayar');

    Route::get('/denda/{id}/qr', [DendaController::class, 'qr'])
        ->name('denda.qr');

    Route::get('/denda/{id}/selesai', [DendaController::class, 'selesai'])
        ->name('denda.selesai');
    
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
});

require __DIR__.'/auth.php';