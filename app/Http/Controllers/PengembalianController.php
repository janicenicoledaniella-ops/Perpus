<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use Carbon\Carbon;
use App\Models\Denda;

class PengembalianController extends Controller
{
   public function kembali($id)
{
    $pinjam = Peminjaman::findOrFail($id);

    if ($pinjam->status == 'dikembalikan') {
        return back()->with('error', 'Buku sudah dikembalikan');
    }

    $today = now();
    $batas_kembali = \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo);

    $denda = 0; // ⬅️ WAJIB ADA (biar ga error)

    if ($today->gt($batas_kembali)) {
        $terlambat = $today->diffInDays($batas_kembali);
        $denda = $terlambat * 1000;

        \App\Models\Denda::create([
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

    \App\Models\Buku::where('isbn', $pinjam->buku_id)->increment('stok');

    if ($denda > 0) {
        return back()->with('success_denda', 'Buku berhasil dikembalikan, Anda memiliki keterlambatan dan denda.');
    } else {
        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}
}