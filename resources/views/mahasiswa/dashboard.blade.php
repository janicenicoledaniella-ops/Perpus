@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    <h2 class="text-xl font-bold mb-4">Dashboard</h2>

    {{-- 🔢 RINGKASAN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white p-6 rounded-xl shadow text-center">
        <p class="text-gray-500">Dipinjam</p>
        <h3 class="text-2xl font-bold">{{ $total }}</h3>
    </div>

    <div class="bg-white p-6 rounded-xl shadow text-center">
        <p class="text-gray-500">Telat</p>
        <h3 class="text-2xl font-bold text-red-500">
            {{ $telat }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-xl shadow text-center">
        <p class="text-gray-500">Denda</p>
        <h3 class="text-2xl font-bold text-yellow-600">
            Rp{{ number_format($denda) }}
        </h3>
    </div>

</div>

    {{-- 📚 PREVIEW BUKU --}}
    <h3 class="text-lg font-bold mb-3">Buku Dipinjam (Terbaru)</h3>

    @if($data->isEmpty())
        <p>Tidak ada buku dipinjam</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($data as $item)
            <div class="bg-white p-4 rounded shadow">

                @if($item->buku && $item->buku->cover)
                    <img src="{{ asset('storage/'.$item->buku->cover) }}"
                         style="width:120px;height:160px;object-fit:cover;margin-bottom:10px;">
                @endif

                <h3 class="font-bold">
                    {{ $item->buku->judul ?? '-' }}
                </h3>

                <p class="text-sm">
                    Jatuh tempo: {{ $item->tanggal_jatuh_tempo }}
                </p>

                @php
                    $telat = now()->gt($item->tanggal_jatuh_tempo);
                @endphp

                @if($telat)
                    <p style="color:red;">Telat</p>
                @else
                    <p style="color:green;">Aman</p>
                @endif

            </div>
        @endforeach

    </div>



    {{-- 🔗 LINK --}}
    <div class="mt-6">
        <a href="{{ route('peminjaman.index') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
           Lihat Semua Peminjaman
        </a>
    </div>

    <div class="mt-4">
    <a href="{{ route('denda.index') }}">
        <button style="background:red;color:white;padding:10px 20px;">
            Lihat Denda
        </button>
    </a>
</div>

    @if($denda > 0)
<div class="mt-4 text-center">
    <a href="{{ route('denda.index') }}">
        <button style="background:red;color:white;padding:10px 20px;">
            Bayar Denda
        </button>
    </a>
</div>
@endif

</div>
@endsection