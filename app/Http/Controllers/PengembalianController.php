<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;

class PengembalianController extends Controller
{
    public function kembali($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status == 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan');
        }

        $pinjam->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        Buku::where('isbn', $pinjam->buku_id)->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}