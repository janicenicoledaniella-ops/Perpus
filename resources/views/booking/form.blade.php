@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">

    <div class="bg-white p-6 rounded shadow flex gap-6">

        {{-- COVER --}}
        <div>
            @if($buku->cover)
                <img src="{{ asset('storage/'.$buku->cover) }}"
                     style="width:150px;height:200px;object-fit:cover;">
            @endif
        </div>

        {{-- DETAIL --}}
        <div>
            <h2 class="text-2xl font-bold mb-2">{{ $buku->judul }}</h2>

            <p><b>Penulis:</b> {{ $buku->penulis }}</p>
            <p><b>Penerbit:</b> {{ $buku->penerbit }}</p>
            <p><b>Tahun:</b> {{ $buku->tahun }}</p>
            <p><b>Kategori:</b> {{ $buku->kategori }}</p>
            <p><b>ISBN:</b> {{ $buku->isbn }}</p>
            <p><b>Stok:</b> {{ $buku->stok }}</p>

            <div class="mt-3">
            <b>Deskripsi:</b>
            <p class="text-gray-700">
            {{ $buku->deskripsi }}
        </p>

            <br>

            {{-- FORM BOOKING --}}
            <form action="{{ route('booking.proses', ['id' => $buku->isbn]) }}" method="POST">
                @csrf

                <p class="font-semibold mb-2">
                    Silahkan Memasukkan Tanggal Pengambilan Buku
                </p>

                <input type="date" name="tanggal"
                    class="border px-3 py-2 rounded mb-4"
                    required>

                <br>

                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Booking Buku
                </button>
            </form>

        </div>
    </div>

</div>
@endsection