<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjaman;

class AdminController extends Controller
{
    public function dashboard()
    {
    $totalDosen = User::where('email', 'like', '03%@lecture.edu')->count();
    $totalMahasiswa = User::where('email', 'like', '04%@student.edu')->count();

    $totalBukuDipinjam = Peminjaman::where('status', 'dipinjam')->count();
    $totalDenda = Denda::sum('total_denda');

    return view('admin.dashboard', compact(
        'totalDosen',
        'totalMahasiswa',
        'totalBukuDipinjam',
        'totalDenda'
    ));
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
            'email.unique'      => 'NIDN sudah digunakan.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);
        $emailLengkap = '03' . $request->email . '@lecture.edu';
        if (User::where('email', $emailLengkap)->exists()) {
            return back()->withErrors(['email' => 'NIDN sudah terdaftar.'])->withInput();
        }
        User::create([
            'name' => $request->name,
            'email' => '03'.$request->email.'@lecture.edu',
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function dosenEdit(int $id)
    {
        $dosen = User::findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function dosenUpdate(Request $request,int $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string',
        ], [
            'name.required'  => 'Nama tidak boleh kosong.',
            'email.required' => 'NIDN tidak boleh kosong.',
        ]);
        $emailLengkap = '03' . $request->email . '@lecture.edu';
        if (User::where('email', $emailLengkap)->where('id', '!=', $id)->exists()) {
            return back()->withErrors(['email' => 'NIDN sudah terdaftar.'])->withInput();
        }
        $dosen = User::findOrFail($id);
        $dosen->update([
            'name' => $request->name,
            'email' => '03'.$request->email.'@lecture.edu',
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diupdate');
    }

    public function dosenDestroy(int $id)
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
            'email.unique'      => 'NIM sudah digunakan.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);
        $emailLengkap = '04' . $request->email . '@student.edu';
        if (User::where('email', $emailLengkap)->exists()) {
            return back()->withErrors(['email' => 'NIM sudah terdaftar.'])->withInput();
        }
        User::create([
            'name' => $request->name,
            'email' => '04'.$request->email.'@student.edu',
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function mahasiswaEdit(int $id)
    {
        $mahasiswa = User::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function mahasiswaUpdate(Request $request, int $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string',
        ], [
            'name.required'  => 'Nama tidak boleh kosong.',
            'email.required' => 'NIM tidak boleh kosong.',
        ]);
        $emailLengkap = '04' . $request->email . '@student.edu';

        if (User::where('email', $emailLengkap)->where('id', '!=', $id)->exists()) {
            return back()->withErrors(['email' => 'NIM sudah terdaftar.'])->withInput();
        }
        $mahasiswa = User::findOrFail($id);
        $mahasiswa->update([
            'name' => $request->name,
            'email' => '04'.$request->email.'@student.edu',
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate');
    }

    public function mahasiswaDestroy(int $id)
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
        Buku::create($data);
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function bukuEdit(int $id)
{
    $data = Buku::findOrFail($id);
    return view('admin.buku.edit', compact('data'));
}

    public function bukuUpdate(Request $request, string $id)
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

    public function bukuDestroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        $sedangDipinjam = $buku->peminjaman()->whereIn('status', ['dipinjam'])->exists();
        
        if ($sedangDipinjam) {
            return redirect()->route('admin.buku.index')->with('error', 'Buku tidak dapat dihapus karena sedang dipinjam.');
        }

        $buku->delete();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.'); 
        }

    public function laporan()
    {
        return view('admin.laporan.index');
    }

    public function laporanFilter(Request $request)
{
    $jenis = $request->jenis;
    $dari = $request->dari;
    $sampai = $request->sampai;

    if ($jenis == 'buku') {
        $data = \App\Models\Buku::all();
        return view('admin.laporan.index', compact('data', 'jenis'));
    }

    if ($jenis == 'peminjaman') {
        $query = \App\Models\Peminjaman::with('user','buku');

        if ($dari && $sampai) {
            $query->whereBetween('tanggal_pinjam', [$dari, $sampai]);
        }

        $data = $query->get();

        return view('admin.laporan.index', compact('data', 'jenis'));
    }

    if ($jenis == 'pengembalian') {
        $query = \App\Models\Peminjaman::with('user','buku');

        if ($dari && $sampai) {
            $query->whereBetween('tanggal_kembali', [$dari, $sampai]);
        }

        $data = $query->get();

        return view('admin.laporan.index', compact('data', 'jenis'));
    }

    if ($jenis == 'denda') {
        $query = \App\Models\Denda::with('user');

        if ($dari && $sampai) {
            $query->whereBetween('created_at', [$dari, $sampai]);
        }

        $data = $query->get();

        return view('admin.laporan.index', compact('data', 'jenis'));
    }

    $bukus = \App\Models\Buku::all();

    $peminjaman = \App\Models\Peminjaman::with('user','buku')
        ->when($dari && $sampai, function ($q) use ($dari, $sampai) {
            $q->whereBetween('tanggal_pinjam', [$dari, $sampai]);
        })
        ->get();

    $pengembalian = \App\Models\Peminjaman::with('user','buku')
        ->when($dari && $sampai, function ($q) use ($dari, $sampai) {
            $q->whereBetween('tanggal_kembali', [$dari, $sampai]);
        })
        ->get();

    $denda = \App\Models\Denda::with('user')
        ->when($dari && $sampai, function ($q) use ($dari, $sampai) {
            $q->whereBetween('created_at', [$dari, $sampai]);
        })
        ->get();

    return view('admin.laporan.index', compact(
        'jenis',
        'bukus',
        'peminjaman',
        'pengembalian',
        'denda'
    ));
}
}