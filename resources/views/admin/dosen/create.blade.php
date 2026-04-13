<h2>Tambah Dosen</h2>

@include('components.form-errors')

<form action="{{ route('admin.dosen.store') }}" method="POST">
    @csrf

    Nama:
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    NIDN:
    <input type="text" name="email" value="{{ old('email') }}">
    @error('email') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    Password:
    <input type="password" name="password">
    @error('password') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
    <br><br>

    <button type="submit">Simpan</button>
</form>