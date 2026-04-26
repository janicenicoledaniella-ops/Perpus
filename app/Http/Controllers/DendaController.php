<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denda;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index()
{
    $peminjaman = \App\Models\Peminjaman::with('buku')
        ->where('user_id', auth()->id())
        ->where('status', 'dipinjam')
        ->get();

    return view('denda.index', compact('peminjaman'));
}

    public function bayar()
    {
        return redirect()->route('denda.qr');
    }

    public function qr()
    {
        return view('denda.qr');
    }

    public function selesai()
    {
        Denda::where('user_id', Auth::id())
            ->where('status', 'belum_bayar')
            ->update(['status' => 'lunas']);

        return view('denda.selesai');
    }
}
