<h2>Tambah Dosen</h2>

<form action="{{ route('admin.dosen.store') }}" method="POST">
    @csrf

    Nama:
    <input type="text" name="name"><br><br>

    NIDN:
    <input type="text" name="email"><br><br>

    Password:
    <input type="password" name="password"><br><br>

    <button type="submit">Simpan</button>
</form>