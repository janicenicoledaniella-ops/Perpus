@extends('layouts.app')

@section('content')
<div style="max-width:1100px;margin:auto;">

<h2 style="margin-bottom:20px;font-size:24px;font-weight:bold;">
    Kelola Peminjaman
</h2>

{{-- SUCCESS --}}
@if(session('success'))
    <div style="background:lightgreen;padding:10px;margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

{{-- ERROR --}}
@if(session('error'))
    <div style="background:pink;padding:10px;margin-bottom:10px;">
        {{ session('error') }}
    </div>
@endif


{{-- ================= BOOKING ================= --}}
<h3 style="margin-top:20px;">Data Booking</h3>

<table style="width:100%; border-collapse:collapse; margin-bottom:30px;">
    <thead>
        <tr style="background:#ddd;">
            <th style="padding:10px;border:1px solid #999;">Nama</th>
            <th style="padding:10px;border:1px solid #999;">Judul Buku</th>
            <th style="padding:10px;border:1px solid #999;">ISBN</th>
            <th style="padding:10px;border:1px solid #999;">Tanggal Booking</th>
            <th style="padding:10px;border:1px solid #999;">Aksi</th>
        </tr>
    </thead>

    <tbody>
    @forelse($booking as $item)
        <tr>
            <td style="padding:10px;border:1px solid #999;">
                {{ $item->user->name }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->buku->judul }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->buku->isbn }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->tanggal_booking }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                <form action="{{ route('admin.ambil', $item->id) }}" method="POST">
                    @csrf
                    <button style="background:blue;color:white;padding:5px 10px;">
                        Pinjam
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" style="text-align:center;padding:10px;">
                Tidak ada booking
            </td>
        </tr>
    @endforelse
    </tbody>
</table>


{{-- ================= SUDAH DIPINJAM ================= --}}
<h3>Buku Sedang Dipinjam</h3>

<table style="width:100%; border-collapse:collapse;">
    <thead>
        <tr style="background:#ccc;">
            <th style="padding:10px;border:1px solid #999;">Nama</th>
            <th style="padding:10px;border:1px solid #999;">Judul Buku</th>
            <th style="padding:10px;border:1px solid #999;">ISBN</th>
            <th style="padding:10px;border:1px solid #999;">Jatuh Tempo</th>
        </tr>
    </thead>

    <tbody>
    @forelse($peminjaman as $item)
        <tr>
            <td style="padding:10px;border:1px solid #999;">
                {{ $item->user->name }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->buku->judul }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->buku->isbn }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->tanggal_jatuh_tempo }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" style="text-align:center;padding:10px;">
                Tidak ada peminjaman
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

</div>
@endsection