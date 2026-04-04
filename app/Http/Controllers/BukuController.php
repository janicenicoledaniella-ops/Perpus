<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('admin.buku.index', compact('bukus'));
    }

    public function create()
    {
        return view('admin.buku.create');
    }

    public function store(Request $request)
    {
          $data = $request->only([
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'isbn',
        'kategori',
        'stok',
        'deskripsi'
    ]);

    if ($request->hasFile('cover')) {
        $path = $request->file('cover')->store('covers', 'public');
        $data['cover'] = $path;
    }

    Buku::create($data);

    return redirect('/buku')->with('success', 'Data berhasil ditambahkan');
    
    }

    public function edit($id)
    {
        $data = Buku::findOrFail($id);
        return view('admin.buku.edit', compact('data'));
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
    
    public function show($id)
    {
    $buku = Buku::where('isbn',$id)->firstOrFail();
    return view('katalog.detail', compact('buku'));

        $buku = Buku::where('isbn', $id)->firstOrFail();
        return view('katalog.detail', compact('buku'));
    }
}
