<h2>Edit Data Dosen</h2>

<form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
    @csrf
    @method('PUT')

    Nama: <input type="text" name="name" value="{{ $dosen->name }}"><br><br>
    Email: <input type="text" name="email" value="{{ $dosen->email }}"><br><br>
    NIDN: <input type="text" name="nidn" value="{{ $dosen->nidn }}"><br><br>
    Password: <input type="password" name="password"><br><br>
    
    
    <button type="submit">Update</button>
</form>