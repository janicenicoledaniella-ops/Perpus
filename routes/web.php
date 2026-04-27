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

Route::get('/', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog', [KatalogController::class, 'index'])->name('buku.katalog');
Route::get('/buku/detail/{id}', [BukuController::class, 'show'])->name('buku.show');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role == 'admin') {
        return redirect('/admin');
    } elseif ($user->role == 'dosen') {
        return redirect('/dosen');
    } else { 
        return redirect('/mahasiswa');
    }
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('dosen')->group(function () {
    Route::get('/', [PeminjamanController::class, 'dashboardDosen'])
        ->name('dosen.dashboard');
});

Route::middleware(['auth'])->prefix('mahasiswa')->group(function () {
    Route::get('/', [PeminjamanController::class, 'dashboardMahasiswa'])
        ->name('mahasiswa.dashboard');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan.index');
    Route::post('/laporan/filter', [AdminController::class, 'laporanFilter'])->name('admin.laporan.filter');

    Route::get('/dosen', [AdminController::class, 'dosenIndex'])->name('admin.dosen.index');
    Route::get('/dosen/create', [AdminController::class, 'dosenCreate'])->name('admin.dosen.create');
    Route::post('/dosen', [AdminController::class, 'dosenStore'])->name('admin.dosen.store');
    Route::get('/dosen/{id}/edit', [AdminController::class, 'dosenEdit'])->name('admin.dosen.edit');
    Route::put('/dosen/{id}', [AdminController::class, 'dosenUpdate'])->name('admin.dosen.update');
    Route::delete('/dosen/{id}', [AdminController::class, 'dosenDestroy'])->name('admin.dosen.destroy');

    Route::get('/mahasiswa', [AdminController::class, 'mahasiswaIndex'])->name('admin.mahasiswa.index');
    Route::get('/mahasiswa/create', [AdminController::class, 'mahasiswaCreate'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa', [AdminController::class, 'mahasiswaStore'])->name('admin.mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [AdminController::class, 'mahasiswaEdit'])->name('admin.mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [AdminController::class, 'mahasiswaUpdate'])->name('admin.mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [AdminController::class, 'mahasiswaDestroy'])->name('admin.mahasiswa.destroy');

    Route::get('/buku', [AdminController::class, 'bukuIndex'])->name('admin.buku.index');
    Route::get('/buku', [AdminController::class, 'bukuIndex'])->name('admin.buku.index');
    Route::get('/buku/create', [AdminController::class, 'bukuCreate'])->name('admin.buku.create');
    Route::post('/buku', [AdminController::class, 'bukuStore'])->name('admin.buku.store');

    Route::get('/buku/{id}/edit', [AdminController::class, 'bukuEdit'])->name('admin.buku.edit');
    Route::put('/buku/{id}', [AdminController::class, 'bukuUpdate'])->name('admin.buku.update');
    Route::delete('/buku/{id}', [AdminController::class, 'bukuDestroy'])->name('admin.buku.destroy');
});

Route::middleware(['auth'])->prefix('operator')->group(function () {
    Route::get('/', [OperatorController::class, 'dashboard'])->name('operator.dashboard');

    Route::get('/akun', [OperatorController::class, 'akunIndex'])->name('operator.akun.index');
    Route::get('/akun/create', [OperatorController::class, 'akunCreate'])->name('operator.akun.create');
    Route::post('/akun', [OperatorController::class, 'akunStore'])->name('operator.akun.store');
    Route::get('/akun/{id}/edit', [OperatorController::class, 'akunEdit'])->name('operator.akun.edit');
    Route::put('/akun/{id}', [OperatorController::class, 'akunUpdate'])->name('operator.akun.update');
    Route::delete('/akun/{id}', [OperatorController::class, 'akunDestroy'])->name('operator.akun.destroy');
});

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

Route::middleware('auth')->group(function () {

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    Route::post('/pinjam/{id}', [PeminjamanController::class, 'pinjam'])
        ->name('peminjaman.pinjam');

    Route::post('/peminjaman/kembali/{id}', [PengembalianController::class, 'kembali'])
    ->name('peminjaman.kembali');

    Route::post('/kembali/{id}', [PengembalianController::class, 'kembali'])
    ->name('kembali');

    Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
    Route::post('/denda/bayar', [DendaController::class, 'bayar'])->name('denda.bayar');
    Route::get('/denda/qr', [DendaController::class, 'qr'])->name('denda.qr');
    Route::get('/denda/selesai', [DendaController::class, 'selesai'])->name('denda.selesai');

});

require __DIR__.'/auth.php';