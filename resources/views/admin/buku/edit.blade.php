<h2>Edit Buku</h2>

<form action="/admin/buku/{{ $data->id }}" method="POST">
    @csrf
    @method('PUT')

    Judul: <input type="text" name="judul" value="{{ $data->judul }}"><br><br>
    Penulis: <input type="text" name="penulis" value="{{ $data->penulis }}"><br><br>
    Penerbit: <input type="text" name="penerbit" value="{{ $data->penerbit }}"><br><br>
    Tahun: <input type="number" name="tahun" value="{{ $data->tahun }}"><br><br>
    ISBN: <input type="text" name="isbn" value="{{ $data->isbn }}"><br><br>
    Kategori: <input type="text" name="kategori" value="{{ $data->kategori }}"><br><br>
    Stok: <input type="number" name="stok" value="{{ $data->stok }}"><br><br>
    Deskripsi: <textarea name="deskripsi">{{ $data->deskripsi }}</textarea><br><br>
    
    <button type="submit">Update</button>
</form>
