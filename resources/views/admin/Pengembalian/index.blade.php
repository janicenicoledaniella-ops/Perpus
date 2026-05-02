@extends('layouts.app')

@section('content')
<div style="max-width:1000px;margin:auto;">

<h2 style="margin-bottom:20px;font-size:24px;font-weight:bold;">
    Kelola Pengembalian
</h2>

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

<table style="width:100%; border-collapse:collapse;">

    <thead>
        <tr style="background:#ccc;">
            <th style="padding:10px;border:1px solid #999;">Nama</th>
            <th style="padding:10px;border:1px solid #999;">Judul Buku</th>
            <th style="padding:10px;border:1px solid #999;">ISBN</th>
            <th style="padding:10px;border:1px solid #999;">Jatuh Tempo</th>
            <th style="padding:10px;border:1px solid #999;">Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($peminjaman as $item)
        <tr>
            <td style="padding:10px;border:1px solid #999;">
                {{ $item->user->name ?? '-' }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->buku->judul ?? '-' }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->buku->isbn ?? '-' }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                {{ $item->tanggal_jatuh_tempo }}
            </td>

            <td style="padding:10px;border:1px solid #999;">
                <form action="{{ route('admin.peminjaman.kembali', $item->id) }}" method="POST">
                    @csrf
                    <button style="background:blue;color:white;padding:5px 10px;">
                        Kembalikan
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" style="padding:10px;text-align:center;">
                Tidak ada data peminjaman
            </td>
        </tr>
    @endforelse

    </tbody>

</table>

</div>
@endsection