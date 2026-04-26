@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    <h2 class="text-xl font-bold mb-4">Buku yang Sedang Dipinjam</h2>

    {{-- 🔴 Notif denda --}}
    @if(session('success_denda'))
        <div style="background:red;color:white;padding:10px;margin-bottom:10px;">
            {{ session('success_denda') }}
        </div>
    @endif

    {{-- 🟢 Notif sukses --}}
    @if(session('success'))
        <div style="background:green;color:white;padding:10px;margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- ❌ Error --}}
    @if(session('error'))
        <div style="background:pink;padding:10px;margin-bottom:10px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Kalau tidak ada data --}}
    @if($peminjaman->isEmpty())
        <p>Tidak ada buku yang sedang dipinjam.</p>
    @endif

    {{-- Loop --}}
    @foreach($peminjaman as $item)

        <div style="border:1px solid #ccc;padding:15px;margin-bottom:15px;border-radius:8px;">

            {{-- Judul --}}
            <h3 style="font-size:18px;">
                <b>{{ $item->buku->judul ?? 'Buku tidak ditemukan' }}</b>
            </h3>

            {{-- Info --}}
            <p>📅 Pinjam: {{ $item->tanggal_pinjam }}</p>
            <p>⏳ Jatuh Tempo: {{ $item->tanggal_jatuh_tempo }}</p>

            {{-- 🔥 HITUNG DENDA MENIT --}}
            @php
                $now = now();
                $jatuh = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);

                $denda = 0;

                if ($now->gt($jatuh)) {
                    $terlambat = ceil($jatuh->diffInSeconds($now) / 60);
                    $denda = $terlambat * 1000;
                }
            @endphp

            {{-- Status --}}
            @if($denda > 0)
                <p style="color:red;font-weight:bold;">
                    Telat! Denda: Rp{{ number_format($denda) }}
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