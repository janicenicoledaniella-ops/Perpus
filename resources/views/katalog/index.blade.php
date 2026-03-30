@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    <form method="GET" action="{{ route('katalog.index') }}" class="mb-4">
        <input type="text" name="q" placeholder="Cari buku..." class="border px-2 py-1">
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Cari</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($bukus as $buku)
            <div class="bg-white p-4 rounded shadow">
                <a href="{{ route('buku.show', $buku->id) }}">
                @if($buku->cover)
            <img src="{{ asset('storage/'.$buku->cover) }}" 
             style="width:120px;height:160px;object-fit:cover;margin-bottom:10px;">
        @endif
                <h3 class="text-xl font-semibold mb-2">{{ $buku->judul }}</h3> </a>
                <p>Penulis: {{ $buku->penulis }}</p>
                <p>Stok: {{ $buku->stok }}</p>
                @auth
                    <a href="#" class="bg-green-500 text-white px-3 py-1 rounded mt-2 inline-block">Pinjam</a>
                @else
                    <a href="{{ route('login') }}" class="bg-gray-500 text-white px-3 py-1 rounded mt-2 inline-block">Login untuk pinjam</a>
                @endauth
            </div>
        @empty
            <p>Tidak ada buku ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection