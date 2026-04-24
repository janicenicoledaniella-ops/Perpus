<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denda;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::with('peminjaman.buku')
            ->where('user_id', Auth::id())
            ->where('status', 'belum_bayar')
            ->get();

        return view('denda.index', compact('dendas'));
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
