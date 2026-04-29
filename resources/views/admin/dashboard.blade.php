@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Selamat Datang, Admin!</h1>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-500">Total Dosen</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalDosen }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-500">Total Mahasiswa</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalMahasiswa }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4 space-y-2">
        <a href="{{ route('admin.dosen.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Kelola Dosen</a>
        <a href="{{ route('admin.mahasiswa.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Kelola Mahasiswa</a>
        <a href="{{ route('admin.buku.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Kelola Buku</a>
        <a href="{{ route('admin.peminjaman.index') }}"class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Kelola Peminjaman</a>
        <a href="{{ route('admin.pengembalian.index') }}"class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Kelola Pengembalian</a>
        <a href="{{ route('admin.laporan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Lihat Laporan</a>
    </div>

</div>
@endsection