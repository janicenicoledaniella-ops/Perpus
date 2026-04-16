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

    $today = Carbon::now();
    $batas_kembali = Carbon::parse($pinjam->tanggal_kembali);

    // CEK TERLAMBAT
    if ($today->gt($batas_kembali)) {
        $terlambat = $today->diffInDays($batas_kembali);
        $denda = $terlambat * 1000; // 1000 per hari

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

    Buku::where('isbn', $pinjam->buku_id)->increment('stok');

    return back()->with('success', 'Buku berhasil dikembalikan');
    }
}