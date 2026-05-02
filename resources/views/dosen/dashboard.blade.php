@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <h2 class="text-2xl font-bold mb-6">Dashboard Saya</h2>

    {{-- 🔢 RINGKASAN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow text-center border-l-4 border-blue-500">
            <p class="text-gray-500">Buku Dipinjam</p>
            <h3 class="text-3xl font-bold text-blue-600">{{ $total }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow text-center border-l-4 border-red-500">
            <p class="text-gray-500">Terlambat</p>
            <h3 class="text-3xl font-bold text-red-500">{{ $telat }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow text-center border-l-4 border-yellow-500">
            <p class="text-gray-500">Total Denda</p>
            <h3 class="text-3xl font-bold text-yellow-600">
                Rp{{ number_format($denda) }}
            </h3>
        </div>

    </div>

    {{-- ⚠️ ALERT DENDA --}}
    @if($denda > 0)
    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-6">
        ⚠️ Kamu memiliki denda yang belum dibayar!
    </div>
    @endif

    {{-- 📚 BUKU DIPINJAM --}}
    <h3 class="text-xl font-bold mb-4">Buku Dipinjam</h3>

    @if($data->isEmpty())
        <p class="text-gray-500">Tidak ada buku dipinjam</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($data as $item)
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">

                {{-- Cover --}}
                @if($item->buku && $item->buku->cover)
                    <img src="{{ asset('storage/'.$item->buku->cover) }}"
                         class="w-full h-48 object-cover rounded mb-3">
                @endif

                {{-- Judul --}}
                <h3 class="font-bold text-lg">
                    {{ $item->buku->judul ?? '-' }}
                </h3>

                {{-- Tanggal --}}
                <p class="text-sm text-gray-500">
                    Jatuh tempo: {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                </p>

                {{-- Status --}}
                @php
                    $telat = now()->gt($item->tanggal_jatuh_tempo);
                @endphp

                @if($telat)
                    <span class="inline-block mt-2 px-3 py-1 text-sm bg-red-500 text-white rounded-full">
                        Terlambat
                    </span>
                @else
                    <span class="inline-block mt-2 px-3 py-1 text-sm bg-green-500 text-white rounded-full">
                        Dipinjam
                    </span>
                @endif

            </div>
        @endforeach

    </div>

    {{-- 🔗 ACTION --}}
    <div class="mt-8 flex gap-4">

        <a href="{{ route('peminjaman.index') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg">
           Lihat Semua Peminjaman
        </a>

        <a href="{{ route('denda.index') }}"
           class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg">
           Detail Denda
        </a>

    </div>

</div>
@endsection