<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    
    public function pinjam($buku_id)
    {
         Peminjaman::create([
        'user_id' => auth()->id(),
        'buku_id' => $buku_id,
        'tanggal_pinjam' => now(),
        'status' => 'menunggu'
        ]);
       return redirect()->route('katalog.index')
    ->with('success', 'Berhasil request pinjam!');
       
    }

   
    public function index()
    {
        $peminjaman = Peminjaman::with('user','buku')->get();
        return view('admin.peminjaman', compact('peminjaman'));
    }

    
    public function approve($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $buku = Buku::findOrFail($pinjam->buku_id);

        if($buku->stok <= 0){
            return back()->with('error', 'Stok habis');
        }

        $pinjam->status = 'dipinjam';
        $pinjam->batas_kembali = now()->addDays(7);
        $pinjam->save();

        $buku->stok -= 1;
        $buku->save();

        return back()->with('success', 'Disetujui');
    }

    
    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $buku = Buku::findOrFail($pinjam->buku_id);

        $pinjam->status = 'dikembalikan';
        $pinjam->tanggal_kembali = now();
        $pinjam->save();

        $buku->stok += 1;
        $buku->save();

        return back()->with('success', 'Dikembalikan');
    }
}