@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6 sm:px-6 lg:px-8">

    <!-- Form pencarian -->
    <form method="GET" action="{{ route('katalog.index') }}" class="mb-4">
        <input type="text" name="q" placeholder="Cari buku..." class="border px-2 py-1">
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Cari</button>
    </form>
    @if(session('success'))
        <div style="background:lightgreen;padding:10px;margin-bottom:10px;">
            <b>{{ session('success') }}</b><br>
            Tenggat: {{ session('jatuh_tempo') }} <br>
            Denda: Rp{{ number_format(session('denda')) }} / hari
        </div>
    @endif

    @if(session('error'))
        <div style="background:pink;padding:10px;margin-bottom:10px;">
            {{ session('error') }}
        </div>
    @endif
    <!-- Daftar buku -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($bukus as $buku)
            <div class="bg-white p-4 rounded shadow">
                <a href="{{ route('buku.show', ['id'=> $buku->isbn]) }}">
                    @if($buku->cover)
                        <img src="{{ asset('storage/'.$buku->cover) }}" 
                             style="width:120px;height:160px;object-fit:cover;margin-bottom:10px;">
                    @endif
                    <h3 class="text-xl font-semibold mb-2">{{ $buku->judul }}</h3>
                </a>
                <p>Penulis: {{ $buku->penulis }}</p>
                <p>Stok: {{ $buku->stok }}</p>

                <!-- Tombol Pinjam -->
                @auth
                    @if($buku->stok > 0)
                        <form action="{{ route('peminjaman.pinjam', ['id'=> $buku->isbn]) }}" method="POST">
                        @csrf
                        <button class="bg-green-500 text-white px-3 py-1 rounded mt-2">
                            Pinjam
                        </button>
                    </form>
                    @else
                        <span class="bg-red-500 text-white px-3 py-1 rounded mt-2 inline-block">
                           Stok Habis
                        </span>
                    @endif
                @else
                    <a href="{{ route('login') }}" 
                       class="bg-gray-500 text-white px-3 py-1 rounded mt-2 inline-block">
                       Login untuk pinjam
                    </a>
                @endauth
            </div>
        @empty
            <p>Tidak ada buku ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection