<h2>Edit Data Dosen</h2>

@include('components.form-errors')

<form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
    @csrf
    @method('PUT')

    Nama:
    <input type="text" name="name" value="{{ old('name', $dosen->name) }}">
    @error('name') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    NIDN:
    <input type="text" name="email" value="{{ old('email', $dosen->email) }}">
    @error('email') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Password: <span style="color:#888; font-size:13px;">(kosongkan jika tidak diubah)</span>
    <input type="password" name="password">
    @error('password') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    <button type="submit">Update</button>
</form>