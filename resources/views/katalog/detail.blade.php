@extends('layouts.app')

@section('content')
<div class="bg-white p-20 rounded shadow flex gap-6">

    {{-- COVER --}}
    <div>
        @if($buku->cover)
            <img src="{{ asset('storage/'.$buku->cover) }}" 
                 style="width:200px;object-fit:cover;">
        @endif
    </div>

    {{-- DETAIL --}}
    <div>
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
            @if(!str_ends_with(Auth::user()->email, '@student.edu') && !str_ends_with(Auth::user()->email, '@lecture.edu'))
            @else
                <a href="{{ route('booking.form', ['id' => $buku->isbn]) }}"
                   style="background:green;color:white;padding:8px 15px;border-radius:5px;display:inline-block;">
                   Booking Buku
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" 
               style="background:gray;color:white;padding:8px 15px;">
               Login untuk Booking
            </a>
        @endauth

    </div>

</div>
@endsection