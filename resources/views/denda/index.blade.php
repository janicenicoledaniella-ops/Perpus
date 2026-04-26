@extends('layouts.app')

@section('content')
<div style="max-width:900px;margin:auto;text-align:center;">

<h2 style="margin-bottom:20px; font-size:32px; font-weight:bold;">
    Daftar Denda
</h2>

<table style="width:100%; border-collapse:collapse; font-size:16px;">

    <thead>
        <tr style="background:#3490dc;color:white;">
            <th style="padding:10px;border:1px solid #ccc;">Judul Buku</th>
            <th style="padding:10px;border:1px solid #ccc;">ISBN</th>
            <th style="padding:10px;border:1px solid #ccc;">Telat (menit)</th>
            <th style="padding:10px;border:1px solid #ccc;">Total Denda</th>
        </tr>
    </thead>

    <tbody>

    @php
        $ada = false;
        $totalSemua = 0;
    @endphp

    @foreach($peminjaman as $item)

        @php
            $jatuh = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
            $now = now();

            $menit = 0;
            $denda = 0;

            if ($now->gt($jatuh)) {

                $menit = floor($jatuh->diffInSeconds($now) / 60);

                if ($menit < 1) {
                    $menit = 1;
                }

                $denda = $menit * 1000;
                $totalSemua += $denda;
                $ada = true;
            }
        @endphp

        @if($denda > 0)
        <tr>
            <td style="padding:10px;border:1px solid #ccc;">
                {{ $item->buku->judul ?? '-' }}
            </td>
            <td style="padding:10px;border:1px solid #ccc;">
                {{ $item->buku->isbn ?? '-' }}
            </td>
            <td style="padding:10px;border:1px solid #ccc;">
                {{ $menit }}
            </td>
            <td style="padding:10px;border:1px solid #ccc;color:red;font-weight:bold;">
                Rp {{ number_format($denda) }}
            </td>
        </tr>
        @endif

    @endforeach

    {{-- KALAU TIDAK ADA DENDA --}}
    @if(!$ada)
    <tr>
        <td colspan="4" style="padding:15px;color:green;font-weight:bold;">
            Anda tidak memiliki denda
        </td>
    </tr>
    @endif

    </tbody>
</table>

{{-- TOTAL --}}
@if($ada)
    <h3 style="margin-top:20px;">
        Total: Rp {{ number_format($totalSemua) }}
    </h3>

    <a href="{{ route('denda.qr') }}">
        <button style="background:red;color:white;padding:12px 25px;border:none;border-radius:5px;margin-top:10px;">
            Bayar Denda
        </button>
    </a>
@endif

</div>
@endsection