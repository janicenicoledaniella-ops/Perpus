@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6 sm:px-6 lg:px-8">

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

    <div class="flex flex-col gap-4">
        @forelse($bukus as $buku)
            <div class="bg-white p-4 rounded shadow flex items-start gap-4">
                <a href="{{ route('buku.show', ['id'=> $buku->isbn]) }}" class="shrink-0">
                    @if($buku->cover)
                        <img src="{{ asset('storage/'.$buku->cover) }}"
                             style="width:100px;height:140px;object-fit:cover;">
                    @endif
                </a>
                <div>
                    <a href="{{ route('buku.show', ['id'=> $buku->isbn]) }}">
                        <h3 class="text-xl font-semibold mb-2">{{ $buku->judul }}</h3>
                    </a>
                    <p>Penulis: {{ $buku->penulis }}</p>
                    <p>Stok: {{ $buku->stok }}</p>

                    @auth
                        @if(!str_ends_with(Auth::user()->email, '@student.edu') && !str_ends_with(Auth::user()->email, '@lecture.edu'))
                        @elseif($buku->stok > 0)
                            <form action="{{ route('peminjaman.pinjam', ['id'=> $buku->isbn]) }}" method="POST">
                                @csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded mt-2">Pinjam</button>
                            </form>
                        @else
                            <span class="bg-red-500 text-white px-3 py-1 rounded mt-2 inline-block">Stok Habis</span>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="bg-gray-500 text-white px-3 py-1 rounded mt-2 inline-block">
                            Login untuk pinjam
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <p>Tidak ada buku ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection