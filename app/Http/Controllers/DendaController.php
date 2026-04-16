<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denda;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::where('user_id', auth()->id())->get();

        return view('denda.index', compact('dendas'));
    }

    public function bayar($id)
    {
        $denda = Denda::findOrFail($id);

        $denda->update([
            'status' => 'sudah_bayar'
        ]);

        return back()->with('success', 'Denda berhasil dibayar');
    }
}
