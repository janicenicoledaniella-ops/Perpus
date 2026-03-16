<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDosen = User::where('email', 'like', '03%@lecture.edu')->count();
        $totalMahasiswa = User::where('email', 'like', '04%@student.edu')->count();

        return view('admin.dashboard', compact('totalDosen', 'totalMahasiswa'));
    }

    
    public function dosenIndex()
    {
        $dosens = User::where('email', 'like', '03%@lecture.edu')->get();
        return view('admin.dosen.index', compact('dosens'));
    }

    public function dosenCreate()
    {
        return view('admin.dosen.create');
    }

    public function dosenStore(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => '03'.$request->email.'@lecture.edu',
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function dosenEdit($id)
    {
        $dosen = User::findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function dosenUpdate(Request $request, $id)
    {
        $dosen = User::findOrFail($id);
        $dosen->update([
            'name' => $request->name,
            'email' => '03'.$request->email.'@lecture.edu',
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diupdate');
    }

    public function dosenDestroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus');
    }


    public function mahasiswaIndex()
    {
        $mahasiswas = User::where('email', 'like', '04%@student.edu')->get();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function mahasiswaCreate()
    {
        return view('admin.mahasiswa.create');
    }

    public function mahasiswaStore(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => '04'.$request->email.'@student.edu',
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function mahasiswaEdit($id)
    {
        $mahasiswa = User::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function mahasiswaUpdate(Request $request, $id)
    {
        $mahasiswa = User::findOrFail($id);
        $mahasiswa->update([
            'name' => $request->name,
            'email' => '04'.$request->email.'@student.edu',
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate');
    }

    public function mahasiswaDestroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
    public function bukuIndex()
    {
        $bukus = Buku::all(); 
        return view('admin.buku.index', compact('bukus'));
    }

    public function bukuCreate()
    {
        return view('admin.buku.create');
    }

    public function bukuStore(Request $request)
    {
        Buku::create($request->all());
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function bukuEdit($id)
{
    $data = Buku::findOrFail($id);
    return view('admin.buku.edit', compact('data'));
}

    public function bukuUpdate(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->all());
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diupdate');
    }

    public function bukuDestroy($id)
    {
        Buku::destroy($id);
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus');
    }
}

