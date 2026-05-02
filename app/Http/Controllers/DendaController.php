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
            ->get();

        return view('denda.index', compact('dendas'));
    }

    public function detail(int $id)
{
    $denda = Denda::with('peminjaman.buku')
        ->where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('denda.detail', compact('denda'));
}

public function qr(int $id)
{
    $denda = Denda::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('denda.qr', compact('denda'));
}

public function bayar(int $id)
{
    $denda = Denda::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $denda->update([
        'status' => 'lunas'
    ]);

    return redirect()->route('denda.selesai', $denda->id);
}

public function selesai(int $id)
{
    $denda = Denda::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('denda.selesai', compact('denda'));
}
}