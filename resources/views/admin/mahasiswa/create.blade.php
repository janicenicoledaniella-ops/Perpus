<h2>Tambah Mahasiswa</h2>

<form action="{{ route('admin.mahasiswa.store') }}" method="POST">
    @csrf

    Nama:
    <input type="text" name="name"><br><br>

    NIM:
    <input type="text" name="email"><br><br>

    Password:
    <input type="password" name="password"><br><br>

    <button type="submit">Simpan</button>
</form>