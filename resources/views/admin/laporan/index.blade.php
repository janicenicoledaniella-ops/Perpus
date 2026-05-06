@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-4">Laporan Perpustakaan</h1>

    <form action="{{ route('admin.laporan.filter') }}" method="POST" style="display:inline;">
        @csrf
        <input type="hidden" name="jenis" value="semua">
    </form>

    <button onclick="toggleFilter()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
        ☰ Pilih Laporan
    </button>

    <hr class="my-4 border-gray-200">

    <div id="filterBox" style="display:none;" class="bg-gray-50 border border-gray-200 rounded-xl p-5 mb-6">
        <h3 class="text-base font-semibold text-gray-700 mb-4">Filter Laporan</h3>

        <form action="{{ route('admin.laporan.filter') }}" method="POST" class="flex flex-wrap items-end gap-4">
            @csrf

            <div class="flex flex-col gap-1">
                <label class="text-xs font-medium text-gray-500">Pilih Laporan</label>
                <select name="jenis" class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="buku">Buku</option>
                    <option value="peminjaman">Peminjaman</option>
                    <option value="pengembalian">Pengembalian</option>
                    <option value="denda">Denda</option>
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs font-medium text-gray-500">Dari</label>
                <input type="date" name="dari" class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs font-medium text-gray-500">Sampai</label>
                <input type="date" name="sampai" class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                Tampilkan
            </button>
        </form>
    </div>

    <script>
    function toggleFilter() {
        var box = document.getElementById("filterBox");
        box.style.display = (box.style.display === "none") ? "block" : "none";
    }
    </script>

    <hr class="my-4 border-gray-200">

    @if(isset($jenis))

    @if($jenis == 'semua')

    <h2 class="text-xl font-bold text-gray-800 mb-6">Semua Laporan</h2>

    <h3 class="text-base font-semibold text-gray-700 mb-3">Buku</h3>
    <div class="overflow-x-auto rounded-xl border-2 border-gray-300 mb-6">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
    <tr>
        <th class="px-4 py-3 text-left border border-gray-300">Judul</th>
        <th class="px-4 py-3 text-left border border-gray-300">ISBN</th>
        <th class="px-4 py-3 text-left border border-gray-300">Penulis</th>
        <th class="px-4 py-3 text-left border border-gray-300">Stok</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bukus as $b)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3 border border-gray-200">{{ $b->judul }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ $b->isbn }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $b->penulis }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $b->stok }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    <h3 class="text-base font-semibold text-gray-700 mb-3">Peminjaman</h3>
    <div class="overflow-x-auto rounded-xl border-2 border-gray-300 mb-6">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
    <tr>
        <th class="px-4 py-3 text-left border border-gray-300">Nama</th>
        <th class="px-4 py-3 text-left border border-gray-300">ID</th>
        <th class="px-4 py-3 text-left border border-gray-300">Judul Buku</th>
        <th class="px-4 py-3 text-left border border-gray-300">ISBN</th>
        <th class="px-4 py-3 text-left border border-gray-300">Tanggal Pinjam</th>
    </tr>
    </thead>
    <tbody>
    @foreach($peminjaman as $p)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3 border border-gray-200">{{ $p->user->name }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ explode('@', $p->user->email)[0] }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $p->buku->judul ?? '-' }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ $p->buku->isbn ?? '-' }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $p->tanggal_pinjam }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    <h3 class="text-base font-semibold text-gray-700 mb-3">Pengembalian</h3>
    <div class="overflow-x-auto rounded-xl border-2 border-gray-300 mb-6">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
    <tr>
        <th class="px-4 py-3 text-left border border-gray-300">Nama</th>
        <th class="px-4 py-3 text-left border border-gray-300">ID</th>
        <th class="px-4 py-3 text-left border border-gray-300">Judul Buku</th>
        <th class="px-4 py-3 text-left border border-gray-300">ISBN</th>
        <th class="px-4 py-3 text-left border border-gray-300">Tanggal Kembali</th>
        <th class="px-4 py-3 text-left border border-gray-300">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pengembalian as $p)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3 border border-gray-200">{{ $p->user->name }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ explode('@', $p->user->email)[0] }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $p->buku->judul ?? '-' }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ $p->buku->isbn ?? '-' }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $p->tanggal_kembali }}</td>
        <td class="px-4 py-3 border border-gray-200">
        @if($p->denda)
            @if($p->denda->status == 'lunas')
                <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-700">Lunas</span>
            @else
                <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-700">Belum Lunas</span>
            @endif
        @else
            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-500">Tidak Ada Denda</span>
        @endif
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    <h3 class="text-base font-semibold text-gray-700 mb-3">Denda</h3>

    @php $total = 0; @endphp

    <div class="overflow-x-auto rounded-xl border-2 border-gray-300 mb-6">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
    <tr>
        <th class="px-4 py-3 text-left border border-gray-300">Nama</th>
        <th class="px-4 py-3 text-left border border-gray-300">ID</th>
        <th class="px-4 py-3 text-left border border-gray-300">Total Denda</th>
    </tr>
    </thead>
    <tbody>
    @foreach($denda as $d)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3 border border-gray-200">{{ $d->user->name }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ explode('@', $d->user->email)[0] }}</td>
        <td class="px-4 py-3 border border-gray-200">Rp {{ $d->total_denda }}</td>
    </tr>
    @php $total += $d->total_denda; @endphp
    @endforeach
    <tr class="bg-gray-50 font-semibold text-gray-800">
        <td class="px-4 py-3 border border-gray-300" colspan="2">Total Keseluruhan</td>
        <td class="px-4 py-3 border border-gray-300">Rp {{ $total }}</td>
    </tr>
    </tbody>
    </table>
    </div>

    @foreach($denda as $d)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3">{{ $d->user->name }}</td>
        <td class="px-4 py-3 text-gray-500">{{ explode('@', $d->user->email)[0] }}</td>
        <td class="px-4 py-3">{{ $d->peminjaman->buku->judul ?? '-' }}</td>
        <td class="px-4 py-3 text-gray-500">{{ $d->peminjaman->buku->isbn ?? '-' }}</td>
        <td class="px-4 py-3">Rp {{ $d->total_denda }}</td>
    </tr>
    @endforeach
    </table>

    @elseif($jenis == 'buku')

    <h2 class="text-xl font-bold text-gray-800 mb-4">Laporan Buku</h2>
    <div class="overflow-x-auto rounded-xl border-2 border-gray-300">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
    <tr>
        <th class="px-4 py-3 text-left border border-gray-300">Judul</th>
        <th class="px-4 py-3 text-left border border-gray-300">ISBN</th>
        <th class="px-4 py-3 text-left border border-gray-300">Penulis</th>
        <th class="px-4 py-3 text-left border border-gray-300">Stok</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $b)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3 border border-gray-200">{{ $b->judul }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ $b->isbn }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $b->penulis }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $b->stok }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    @elseif($jenis == 'peminjaman')

    <h2 class="text-xl font-bold text-gray-800 mb-4">Laporan Peminjaman</h2>
    <div class="overflow-x-auto rounded-xl border-2 border-gray-300">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
    <tr>
        <th class="px-4 py-3 text-left border border-gray-300">Nama</th>
        <th class="px-4 py-3 text-left border border-gray-300">ID</th>
        <th class="px-4 py-3 text-left border border-gray-300">Judul Buku</th>
        <th class="px-4 py-3 text-left border border-gray-300">ISBN</th>
        <th class="px-4 py-3 text-left border border-gray-300">Tanggal Pinjam</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $p)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3 border border-gray-200">{{ $p->user->name }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ explode('@', $p->user->email)[0] }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $p->buku->judul ?? '-' }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ $p->buku->isbn ?? '-' }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $p->tanggal_pinjam }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    @elseif($jenis == 'pengembalian')

    <h2 class="text-xl font-bold text-gray-800 mb-4">Laporan Pengembalian</h2>
    <div class="overflow-x-auto rounded-xl border-2 border-gray-300">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
    <tr>
        <th class="px-4 py-3 text-left border border-gray-300">Nama</th>
        <th class="px-4 py-3 text-left border border-gray-300">ID</th>
        <th class="px-4 py-3 text-left border border-gray-300">Judul Buku</th>
        <th class="px-4 py-3 text-left border border-gray-300">ISBN</th>
        <th class="px-4 py-3 text-left border border-gray-300">Tanggal Kembali</th>
        <th class="px-4 py-3 text-left border border-gray-300">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $p)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3 border border-gray-200">{{ $p->user->name }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ explode('@', $p->user->email)[0] }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $p->buku->judul ?? '-' }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ $p->buku->isbn ?? '-' }}</td>
        <td class="px-4 py-3 border border-gray-200">{{ $p->tanggal_kembali }}</td>
        <td class="px-4 py-3 border border-gray-200">
            @if($p->denda)
                @if($p->denda->status == 'lunas')
                    <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-700">Lunas</span>
                @else
                    <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-700">Belum Lunas</span>
                @endif
            @else
                <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-500">Tidak Ada Denda</span>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    @elseif($jenis == 'denda')

    <h2 class="text-xl font-bold text-gray-800 mb-4">Laporan Denda</h2>

    @php $total = 0; @endphp

    <div class="overflow-x-auto rounded-xl border-2 border-gray-300">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
    <tr>
        <th class="px-4 py-3 text-left border border-gray-300">Nama</th>
        <th class="px-4 py-3 text-left border border-gray-300">ID</th>
        <th class="px-4 py-3 text-left border border-gray-300">Total Denda</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 py-3 border border-gray-200">{{ $d->user->name }}</td>
        <td class="px-4 py-3 border border-gray-200 text-gray-500">{{ explode('@', $d->user->email)[0] }}</td>
        <td class="px-4 py-3 border border-gray-200">Rp {{ $d->total_denda }}</td>
    </tr>
    @php $total += $d->total_denda; @endphp
    @endforeach
    <tr class="bg-gray-50 font-semibold text-gray-800">
        <td class="px-4 py-3 border border-gray-300" colspan="2">Total Keseluruhan</td>
        <td class="px-4 py-3 border border-gray-300">Rp {{ $total }}</td>
    </tr>
    </tbody>
    </table>
    </div>

    @endif

    <div class="mt-6">
       <button onclick="window.print()" 
            class="inline-flex items-center gap-2 px-5 py-2.5 text-white text-sm font-semibold rounded-lg shadow-md transition-colors" style="background-color: #166534;">
            🖨️ Cetak Laporan
       </button>
    </div>

    @endif
</div>
@endsection