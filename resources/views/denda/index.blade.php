@extends('layouts.app')

@section('content')

<h2>Daftar Denda</h2>

@foreach($dendas as $item)

<div style="border:1px solid #ccc;padding:15px;margin-bottom:10px;">

    <h3>{{ $item->peminjaman->buku->judul }}</h3>

    <p>Denda: Rp {{ number_format(max(0, $item->total_denda)) }}</p>
    <p>Status: 
        @if($item->status == 'lunas')
            <span style="color:green;">Lunas</span>
        @else
            <span style="color:red;">Belum Bayar</span>
        @endif
    </p>

    <a href="{{ route('denda.detail', $item->id) }}">
        <button>Detail Denda</button>
    </a>

    @if($item->status == 'belum_bayar')
<a href="{{ route('denda.qr', $item->id) }}">
    <button style="background:red;color:white;padding:5px;">
        Bayar
    </button>
</a>
@endif

</div>

@endforeach

@endsection