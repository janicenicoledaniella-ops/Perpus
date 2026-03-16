<h2>Tambah Buku</h2>

<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    Judul: <input type="text" name="judul"><br><br>
    Penulis: <input type="text" name="penulis"><br><br>
    Penerbit: <input type="text" name="penerbit"><br><br>
    Tahun: <input type="number" name="tahun"><br><br>
    ISBN: <input type="text" name="isbn"><br><br>
    kategori: <input type="text" name="kategori"><br><br>
    Stok: <input type="number" name="stok"><br><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br><br>

    <div class="mb-3">
    <label>Cover Buku</label>
    <input type="file" name="cover" class="border p-2 w-full">
</div>

    <button type="submit">Simpan</button>
</form>
