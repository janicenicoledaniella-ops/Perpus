<h2>Edit Data Mahasiswa</h2>

@include('components.form-errors')

<form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
    @csrf
    @method('PUT')

    Nama:
    <input type="text" name="name" value="{{ old('name', $mahasiswa->name) }}">
    @error('name') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    NIM:
    <input type="text" name="email" value="{{ old('email', $mahasiswa->email) }}">
    @error('email') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Password: <span style="color:#888; font-size:13px;">(kosongkan jika tidak diubah)</span>
    <input type="password" name="password">
    @error('password') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    <button type="submit">Update</button>
</form>