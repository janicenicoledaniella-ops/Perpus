<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    

public function index()
{
    $peminjaman = Peminjaman::with('buku')
        ->where('user_id', Auth::id())
        ->where('status', 'dipinjam')
        ->get();

    foreach ($peminjaman as $item) {

        $jatuhTempo = Carbon::parse($item->tanggal_jatuh_tempo)->startOfDay();
        $sekarang   = now()->startOfDay();

        if ($sekarang->gt($jatuhTempo)) {

            $hari = $jatuhTempo->diffInDays($sekarang);

            $item->denda = $hari * 1000;

        } else {
            $item->denda = 0;
        }
    }

    return view('peminjaman.index', compact('peminjaman'));
}
    public function dashboardUser()
{
    $data = Peminjaman::with('buku')
        ->where('user_id', Auth::id())
        ->where('status', 'dipinjam')
        ->get();

    return view('dashboard.user', compact('data'));
}

public function dashboardMahasiswa()
{
    $query = Peminjaman::with('buku')
        ->where('user_id', Auth::id())
        ->where('status', 'dipinjam');

    $total = $query->count();

    $telat = $query->get()->filter(function ($item) {
        return now()->gt($item->tanggal_jatuh_tempo);
    })->count();

    $denda = 0;
   foreach ($query->get() as $item) {

    $jatuhTempo = Carbon::parse($item->tanggal_jatuh_tempo)->startOfDay();
    $sekarang   = now()->startOfDay();

    if ($sekarang->gt($jatuhTempo)) {

        $hari = $jatuhTempo->diffInDays($sekarang);

        $denda += $hari * 1000;
    }
}

    // ambil 3 buku terbaru
    $data = $query->latest()->take(3)->get();

    return view('mahasiswa.dashboard', compact('data', 'total', 'telat', 'denda'));
}

public function dashboardDosen()
{
    return $this->dashboardMahasiswa();
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