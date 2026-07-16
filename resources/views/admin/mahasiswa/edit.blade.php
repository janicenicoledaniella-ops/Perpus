@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Data Mahasiswa</h2>

    @include('components.form-errors')

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $mahasiswa->name) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 border">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                <input type="text" name="email" value="{{ old('email', $mahasiswa->email) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 border">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-500 hover:underline text-sm">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
