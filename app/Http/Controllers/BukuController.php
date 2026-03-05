<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $data = Buku::all();
        return view('buku.index', compact('data'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        Buku::create($request->all());
        return redirect('/buku')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Buku::findOrFail($id);
        return view('buku.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Buku::findOrFail($id);
        $data->update($request->all());
        return redirect('/buku')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Buku::destroy($id);
        return redirect('/buku')->with('success', 'Data berhasil dihapus');
    }
}
