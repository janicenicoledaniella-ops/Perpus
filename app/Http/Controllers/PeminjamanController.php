<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
{
    $peminjaman = Peminjaman::with('buku')
        ->where('user_id', Auth::id())
        ->where('status', 'dipinjam')
        ->get();

    return view('peminjaman.index', compact('peminjaman'));
}
    

public function pinjam($id)
{
    $user = Auth::user();
    if (!str_ends_with($user->email, '@student.edu') && !str_ends_with($user->email, '@lecture.edu')) {
        return back()->with('error', 'Admin tidak dapat meminjam buku.');
    }
    $buku = Buku::where('isbn', $id)->first();

    if (!$buku) {
        return back()->with('error', 'Buku tidak ditemukan');
    }

    if ($buku->stok > 0) {

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->isbn, 
            'tanggal_pinjam' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(7),
            'status' => 'dipinjam'
        ]);

        $buku->decrement('stok');

      return redirect()->route('katalog.index')
    ->with('success', 'Buku berhasil dipinjam')
    ->with('jatuh_tempo', now()->addDays(7)->format('d-m-Y'))
    ->with('denda', 1000);
    }

    return back()->with('error', 'Stok habis');
}
}