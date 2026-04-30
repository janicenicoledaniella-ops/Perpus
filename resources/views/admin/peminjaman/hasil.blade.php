@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    <div class="bg-green-500 text-white p-3 mb-4 rounded">
        Buku berhasil dipinjam
    </div>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th>Nama</th>
                <th>ID</th>
                <th>Judul</th>
                <th>ISBN</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
            </tr>
        </thead>

        <tbody>
            <tr class="text-center border-t">
                <td>{{ $data->user->name }}</td>
                <td>{{ $data->user->id }}</td>
                <td>{{ $data->buku->judul }}</td>
                <td>{{ $data->buku->isbn }}</td>
                <td>{{ $data->tanggal_pinjam }}</td>
                <td>{{ $data->tanggal_jatuh_tempo }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('admin.peminjaman.index') }}"
        class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded">
        Kembali ke Dashboard
    </a>

</div>
@endsection