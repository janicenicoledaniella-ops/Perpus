@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Kelola Buku
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    <!-- Tombol Tambah Buku -->
    <div class="mb-4">
        <a href="{{ route('admin.buku.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Tambah Buku
        </a>
    </div>

    <!-- Tabel Daftar Buku -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Judul</th>
                    <th class="px-4 py-2 border">Penulis</th>
                    <th class="px-4 py-2 border">Penerbit</th>
                    <th class="px-4 py-2 border">Tahun</th>
                    <th class="px-4 py-2 border">ISBN</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Stok</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bukus as $buku)
                <tr>
                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border">{{ $buku->judul }}</td>
                    <td class="px-4 py-2 border">{{ $buku->penulis }}</td>
                    <td class="px-4 py-2 border">{{ $buku->penerbit }}</td>
                    <td class="px-4 py-2 border">{{ $buku->tahun }}</td>
                    <td class="px-4 py-2 border">{{ $buku->isbn }}</td>
                    <td class="px-4 py-2 border">{{ $buku->kategori }}</td>
                    <td class="px-4 py-2 border">{{ $buku->stok }}</td>
                     <td class="px-4 py-2 border">{{ $buku->deskripsi }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('admin.buku.edit', $buku->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>

                        <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 border text-center">Belum ada buku</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection