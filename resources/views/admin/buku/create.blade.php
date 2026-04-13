<h2>Tambah Buku</h2>

@include('components.form-errors')

<form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    Judul:
    <input type="text" name="judul" value="{{ old('judul') }}">
    @error('judul') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Penulis:
    <input type="text" name="penulis" value="{{ old('penulis') }}">
    @error('penulis') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Penerbit:
    <input type="text" name="penerbit" value="{{ old('penerbit') }}">
    @error('penerbit') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Tahun:
    <input type="number" name="tahun" value="{{ old('tahun') }}">
    @error('tahun') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    ISBN:
    <input type="text" name="isbn" value="{{ old('isbn') }}">
    @error('isbn') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Kategori:
    <input type="text" name="kategori" value="{{ old('kategori') }}">
    @error('kategori') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Stok:
    <input type="number" name="stok" value="{{ old('stok') }}">
    @error('stok') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Deskripsi:
    <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
    @error('deskripsi') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Cover Buku:
    <input type="file" name="cover" class="border p-2 w-full">
    @error('cover') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    <button type="submit">Simpan</button>
</form>