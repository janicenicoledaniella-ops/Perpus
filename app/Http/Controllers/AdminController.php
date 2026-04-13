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
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'name.required'     => 'Nama tidak boleh kosong.',
            'email.required'    => 'NIDN tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);
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
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string',
        ], [
            'name.required'  => 'Nama tidak boleh kosong.',
            'email.required' => 'NIDN tidak boleh kosong.',
        ]);
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
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'name.required'     => 'Nama tidak boleh kosong.',
            'email.required'    => 'NIM tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);
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
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string',
        ], [
            'name.required'  => 'Nama tidak boleh kosong.',
            'email.required' => 'NIM tidak boleh kosong.',
        ]);
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
        $request->validate([
            'judul'    => 'required|string|max:255',
            'penulis'  => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun'    => 'required|integer|digits:4',
            'isbn'     => 'required|string|max:20|unique:bukus,isbn',
            'kategori' => 'required|string|max:100',
            'stok'     => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'cover'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'judul.required'    => 'Judul tidak boleh kosong.',
            'penulis.required'  => 'Penulis tidak boleh kosong.',
            'penerbit.required' => 'Penerbit tidak boleh kosong.',
            'tahun.required'    => 'Tahun tidak boleh kosong.',
            'tahun.digits'      => 'Tahun harus 4 digit angka.',
            'isbn.required' => 'ISBN tidak boleh kosong.',
            'isbn.unique'   => 'ISBN sudah terdaftar, gunakan ISBN lain.',
            'kategori.required' => 'Kategori tidak boleh kosong.',
            'stok.required'     => 'Stok tidak boleh kosong.',
            'stok.min'          => 'Stok tidak boleh negatif.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
            'cover.required'    => 'Cover buku wajib diupload.',
            'cover.image'       => 'File harus berupa gambar.',
            'cover.mimes'       => 'Format cover harus jpg, jpeg, atau png.',
            'cover.max'         => 'Ukuran cover maksimal 2MB.',
        ]);
 
        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun', 'isbn', 'kategori', 'stok', 'deskripsi']);
 
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $data['cover'] = $path;
        }
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
        $request->validate([
            'judul'    => 'required|string|max:255',
            'penulis'  => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun'    => 'required|integer|digits:4',
            'isbn'     => 'required|string|max:20|unique:bukus,isbn,' . $id . ',isbn',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'stok'     => 'required|integer|min:0',
        ], [
            'judul.required'    => 'Judul tidak boleh kosong.',
            'penulis.required'  => 'Penulis tidak boleh kosong.',
            'penerbit.required' => 'Penerbit tidak boleh kosong.',
            'tahun.required'    => 'Tahun tidak boleh kosong.',
            'tahun.digits'      => 'Tahun harus 4 digit angka.',
            'isbn.required'     => 'ISBN tidak boleh kosong.',
            'isbn.unique'       => 'ISBN sudah terdaftar, gunakan ISBN lain.',
            'kategori.required' => 'Kategori tidak boleh kosong.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
            'stok.required'     => 'Stok tidak boleh kosong.',
            'stok.min'          => 'Stok tidak boleh negatif.',
        ]);
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

