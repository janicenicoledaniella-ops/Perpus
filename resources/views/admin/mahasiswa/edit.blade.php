<h2>Edit Data Mahasiswa</h2>

<form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
    @csrf
    @method('PUT')

    Nama: <input type="text" name="name" value="{{ $mahasiswa->name }}"><br><br>
    Email: <input type="text" name="email" value="{{ $mahasiswa->email }}"><br><br>
    NIM: <input type="text" name="nim" value="{{ $mahasiswa->nim }}"><br><br> 
    Password: <input type="password" name="password"><br><br>
    
    
    <button type="submit">Update</button>
</form>