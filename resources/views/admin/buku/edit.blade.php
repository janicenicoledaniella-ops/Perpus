<h2>Edit Buku</h2>

@include('components.form-errors')

<form action="{{ route('admin.buku.update', $data->isbn) }}" method="POST">
    @csrf
    @method('PUT')

    Judul:
    <input type="text" name="judul" value="{{ old('judul', $data->judul) }}">
    @error('judul') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Penulis:
    <input type="text" name="penulis" value="{{ old('penulis', $data->penulis) }}">
    @error('penulis') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Penerbit:
    <input type="text" name="penerbit" value="{{ old('penerbit', $data->penerbit) }}">
    @error('penerbit') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Tahun:
    <input type="number" name="tahun" value="{{ old('tahun', $data->tahun) }}">
    @error('tahun') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    ISBN:
    <input type="text" name="isbn" value="{{ old('isbn', $data->isbn) }}">
    @error('isbn') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Kategori:
    <input type="text" name="kategori" value="{{ old('kategori', $data->kategori) }}">
    @error('kategori') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Stok:
    <input type="number" name="stok" value="{{ old('stok', $data->stok) }}">
    @error('stok') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Deskripsi:
    <textarea name="deskripsi">{{ old('deskripsi', $data->deskripsi) }}</textarea>
    @error('deskripsi') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    <button type="submit">Update</button>
</form>