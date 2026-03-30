<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PeminjamanController;


Route::get('/', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog', [KatalogController::class, 'index'])->name('buku.katalog');
Route::get('/buku/detail/{id}', [BukuController::class, 'show'])->name('buku.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return "Halaman Profile";
    })->name('profile.edit');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

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

    
    Route::get('/laporan', [AdminController::class, 'laporanIndex'])->name('admin.laporan.index');
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

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('user.dashboard');
});

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

Route::middleware('auth')->group(function () {
    Route::get('/admin/laporan', function() {
        return "Halaman Laporan Admin (sementara)";
    })->name('admin.laporan');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/admin/buku', [AdminController::class, 'bukuIndex'])->name('admin.buku.index');
    
    Route::get('/admin/buku/create', [AdminController::class, 'bukuCreate'])->name('admin.buku.create');
    Route::post('/admin/buku', [AdminController::class, 'bukuStore'])->name('admin.buku.store');

    Route::get('/admin/buku/{id}/edit', [AdminController::class, 'bukuEdit'])->name('admin.buku.edit');
    Route::put('/admin/buku/{id}', [AdminController::class, 'bukuUpdate'])->name('admin.buku.update');

    Route::delete('/admin/buku/{id}', [AdminController::class, 'bukuDestroy'])->name('admin.buku.destroy');


Route::resource('buku', BukuController::class)->except(['show']);
});


require __DIR__.'/auth.php';