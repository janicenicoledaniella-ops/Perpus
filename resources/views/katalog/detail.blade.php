@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">

    <div class="bg-white p-6 rounded shadow">

        @if($buku->cover)
            <img src="{{ asset($buku->cover) }}" 
                 style="width:200px;margin-bottom:20px;">
        @endif

        <h1 style="font-size:24px;font-weight:bold;">
            {{ $buku->judul }}
        </h1>

        <p><b>Penulis:</b> {{ $buku->penulis }}</p>
        <p><b>Penerbit:</b> {{ $buku->penerbit }}</p>
        <p><b>Tahun:</b> {{ $buku->tahun }}</p>
        <p><b>Kategori:</b> {{ $buku->kategori }}</p>
        <p><b>ISBN:</b> {{ $buku->isbn }}</p>
        <p><b>Stok:</b> {{ $buku->stok }}</p>

        <p style="margin-top:10px;">
            <b>Deskripsi:</b><br>
            {{ $buku->deskripsi }}
        </p>

        <br>

        @auth
            <button style="background:green;color:white;padding:8px 15px;">
                Pinjam Buku
            </button>
        @else
            <a href="{{ route('login') }}" 
               style="background:gray;color:white;padding:8px 15px;">
               Login untuk Pinjam
            </a>
        @endauth

    </div>

</div>
@endsection