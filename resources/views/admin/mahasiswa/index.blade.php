@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Mahasiswa</h1>

    <a href="{{ route('admin.mahasiswa.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah mahasiswa</a>

    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswas as $mahasiswa)
            <tr>
                <td class="py-2 px-4 border-b">{{ $mahasiswa->name }}</td>
                <td class="py-2 px-4 border-b">{{ $mahasiswa->email }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-4">Belum ada data Mahasiswa</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection