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

        return view('peminjaman.index', compact('peminjaman'));
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

        $data = $query->latest()->take(3)->get();

        return view('mahasiswa.dashboard', compact('data', 'total', 'telat', 'denda'));
    }

    public function dashboardDosen()
    {
        return $this->dashboardMahasiswa();
    }

    public function pinjam(int $id)
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
                ->with('success', 'Buku berhasil dipinjam');
        }

        return back()->with('error', 'Stok habis');
    }

    // ================== BOOKING ==================

    public function formBooking(int $id)
    {
        $buku = Buku::where('isbn', $id)->firstOrFail();
        return view('booking.form', compact('buku'));
    }

    public function prosesBooking(Request $request,int $id)
{
    $request->validate([
        'tanggal' => 'required|date'
    ]);

    $buku = Buku::where('isbn', $id)->firstOrFail();

    if ($buku->stok <= 0) {
        return back()->with('error', 'Stok habis');
    }

    Peminjaman::create([
        'user_id' => Auth::id(),
        'buku_id' => $buku->isbn,
        'tanggal_pinjam' => null, 
        'tanggal_jatuh_tempo' => null,
        'status' => 'booking', 
        'tanggal_booking' => $request->tanggal 
    ]);

    return redirect()->route('katalog.index')
        ->with('success', 'Booking berhasil! tanggal pengambilan buku: '.$request->tanggal);
}

    public function adminIndex()
{
    $booking = Peminjaman::with('buku','user')
    ->where(function($q){
        $q->where('status', 'booking')
          ->orWhere(function($q2){
              $q2->where('status', 'dipinjam')
                 ->whereNotNull('diambil_at')
                 ->where('diambil_at', '>=', now()->subDay()); 
          });
    })
    ->get();

    $peminjaman = Peminjaman::with('buku','user')
        ->where('status', 'dipinjam')
        ->get();

    $bukus = Buku::all();

    return view('admin.peminjaman.index', compact('booking', 'peminjaman', 'bukus'));
}

public function ambilBuku(int $id)
{
    $booking = Peminjaman::findOrFail($id);

    // update jadi dipinjam
    $booking->update([
        'status' => 'dipinjam',
        'tanggal_pinjam' => now(),
        'tanggal_jatuh_tempo' => now()->addDays(7),
        'diambil_at' => now() 
    ]);

    return redirect()->back()->with('success', 'Buku berhasil diambil');
}
    public function pinjamManual(Request $request)
{
    $user = \App\Models\User::find($request->user_id);
    $buku = \App\Models\Buku::where('isbn', $request->buku_id)->first();

    if (!$user || !$buku) {
        return back()->with('error', 'Data tidak ditemukan');
    }

    $data = \App\Models\Peminjaman::create([
        'user_id' => $user->id,
        'buku_id' => $buku->isbn,
        'tanggal_pinjam' => now(),
        'tanggal_jatuh_tempo' => now()->addDays(7),
        'status' => 'dipinjam'
    ]);

    // 👉 PINDAH KE HALAMAN BARU
    return redirect()->route('admin.peminjaman.hasil', $data->id);
}

public function hasil(int $id)
{
    $data = Peminjaman::with('user','buku')->findOrFail($id);

    return view('admin.peminjaman.hasil', compact('data'));
}
}