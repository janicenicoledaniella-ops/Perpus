@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    <h2 class="text-xl font-bold mb-4">Buku yang Sedang Dipinjam</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div style="background:lightgreen;padding:10px;margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:pink;padding:10px;margin-bottom:10px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Kalau tidak ada data --}}
    @if($peminjaman->isEmpty())
        <p>Tidak ada buku yang sedang dipinjam.</p>
    @endif

    {{-- Loop data --}}
    @foreach($peminjaman as $item)

        @php
            $telat = now()->gt($item->tanggal_jatuh_tempo);
        @endphp

        <div style="border:1px solid #ccc;padding:15px;margin-bottom:15px;border-radius:8px;">

            {{-- Judul --}}
            <h3 style="font-size:18px;">
                <b>{{ $item->buku->judul ?? 'Buku tidak ditemukan' }}</b>
            </h3>

            {{-- Info --}}
            <p>📅 Pinjam: {{ $item->tanggal_pinjam }}</p>
            <p>⏳ Jatuh Tempo: {{ $item->tanggal_jatuh_tempo }}</p>

            {{-- Status --}}
            @if($telat)
                <p style="color:red;font-weight:bold;">
                    Telat! Denda: Rp{{ number_format($item->denda) }}
                </p>
            @else
                <p style="color:green;font-weight:bold;">
                    Belum telat
                </p>
            @endif

            {{-- Tombol --}}
            <form action="{{ route('peminjaman.kembali', $item->id) }}" method="POST">
                @csrf
                <button style="background:red;color:white;padding:6px 12px;margin-top:8px;border:none;border-radius:4px;">
                    Kembalikan
                </button>
            </form>

        </div>

    @endforeach

</div>
@endsection