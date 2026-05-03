@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    <h1 class="text-2xl font-bold mb-6">Booking Buku</h1>

    @if($booking->isEmpty())
        <p class="text-gray-500">Belum ada booking buku</p>
    @endif

    <div class="space-y-6">

        @foreach($booking as $b)
        <div class="bg-white rounded-2xl shadow p-6 flex gap-6 items-center">

            {{-- COVER --}}
            @if($b->buku && $b->buku->cover)
                <img src="{{ asset('storage/'.$b->buku->cover) }}"
                     class="w-28 h-40 object-cover rounded">
            @endif

            {{-- INFO --}}
            <div class="flex-1">
                <h2 class="text-xl font-bold mb-1">
                    {{ $b->buku->judul }}
                </h2>

                <p class="text-gray-600 mb-4">
                    Penulis: {{ $b->buku->penulis }}
                </p>

                <p class="text-gray-700 font-semibold">
                    Tanggal Pengambilan Buku
                </p>

                <p class="text-gray-500 mb-3">
                    {{ \Carbon\Carbon::parse($b->tanggal_booking)->format('d-m-Y') }}
                </p>

                {{-- STATUS --}}
                @if($b->status == 'booking')
                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">
                        Menunggu Diambil
                    </span>

                @elseif($b->status == 'dipinjam')
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                        Buku Sudah Diambil
                    </span>
                @endif
            </div>

        </div>
        @endforeach

    </div>

</div>
@endsection