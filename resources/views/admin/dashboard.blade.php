@extends('layouts.app')

@section('content')
<h1>Selamat Datang Admin!</h1>
<p>Total Dosen: {{ $totalDosen }}</p>
<p>Total Mahasiswa: {{ $totalMahasiswa }}</p>

<ul>
    <li><a href="{{ route('admin.dosen.index') }}">Kelola Dosen</a></li>
    <li><a href="{{ route('admin.mahasiswa.index') }}">Kelola Mahasiswa</a></li>
    <li><a href="{{ route('admin.buku.index') }}">Kelola Buku</a></li>
    <li><a href="{{ route('admin.laporan') }}">Lihat Laporan</a></li>
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>
    </li>
</ul>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection