@extends('layouts.app')

@section('content')

<h2>Detail Denda</h2>

<div style="border:1px solid #ccc;padding:20px;width:400px;">

    <p><b>Judul Buku:</b> {{ $denda->peminjaman->buku->judul }}</p>

    <p><b>Jumlah Hari Terlambat:</b> {{ $denda->jumlah_hari_terlambat }} hari</p>

    <p><b>Total Denda:</b> Rp {{ number_format($denda->total_denda) }}</p>

    <p><b>Status:</b> 
        @if($denda->status == 'lunas')
            <span style="color:green;">Lunas</span>
        @else
            <span style="color:red;">Belum Bayar</span>
        @endif
    </p>

</div>

<br>

<a href="{{ route('denda.index') }}">
    <button>Kembali</button>
</a>

@endsection