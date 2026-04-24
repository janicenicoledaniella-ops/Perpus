@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Buku</h2>

    @include('components.form-errors')

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.buku.update', $data->isbn) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $data->judul) }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis', $data->penulis) }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('penulis') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $data->penerbit) }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('penerbit') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun', $data->tahun) }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('tahun') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $data->stok) }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('stok') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $data->isbn) }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('isbn') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori', $data->kategori) }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('kategori') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('admin.buku.index') }}" class="text-gray-500 hover:underline text-sm">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
