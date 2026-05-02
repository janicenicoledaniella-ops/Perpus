<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Denda;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
{
    $peminjaman = Peminjaman::with('buku', 'user')
        ->where('status', 'dipinjam')
        ->get();

    return view('admin.pengembalian.index', compact('peminjaman'));
}
   public function kembali(int $id)
{
    $pinjam = Peminjaman::with('buku')->findOrFail($id);

    if ($pinjam->status == 'dikembalikan') {
        return back()->with('error', 'Buku sudah dikembalikan');
    }

    // 🔥 PENTING: samakan ke awal hari
    $today = now()->startOfDay();
    $batas = \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->startOfDay();

    $denda = 0;
    $terlambat = 0;

    if ($today->gt($batas)) {

        $terlambat = max(1, $batas->diffInDays($today)); // ❗ anti minus
    $denda = max(0, $terlambat * 1000);              // ❗ anti minus


        Denda::create([
            'user_id' => $pinjam->user_id,
            'peminjaman_id' => $pinjam->id,
            'jumlah_hari_terlambat' => $terlambat,
            'total_denda' => $denda,
            'status' => 'belum_bayar'
        ]);
    }

    $pinjam->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => $today
    ]);

    $pinjam->buku->increment('stok');

    return back()->with('success', 'Buku dikembalikan');
}
}