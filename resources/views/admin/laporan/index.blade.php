<h1>Laporan Perpustakaan</h1>

<form action="{{ route('admin.laporan.filter') }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="jenis" value="semua">
</form>

<button onclick="toggleFilter()">Pilih Laporan</button>

<hr>

<div id="filterBox" style="display:none;">
    <h3>Filter Laporan</h3>

    <form action="{{ route('admin.laporan.filter') }}" method="POST">
        @csrf

        <label>Pilih Laporan:</label>
        <select name="jenis">
            <option value="buku">Buku</option>
            <option value="peminjaman">Peminjaman</option>
            <option value="pengembalian">Pengembalian</option>
            <option value="denda">Denda</option>
        </select>

        <br><br>

        <label>Dari:</label>
        <input type="date" name="dari">

        <label>Sampai:</label>
        <input type="date" name="sampai">

        <br><br>

        <button type="submit">Tampilkan</button>
    </form>
</div>

<script>
function toggleFilter() {
    var box = document.getElementById("filterBox");
    box.style.display = (box.style.display === "none") ? "block" : "none";
}
</script>

<hr>

@if(isset($jenis))

@if($jenis == 'semua')

<h2>Semua Laporan</h2>

<h3>Buku</h3>
<table border="1" cellpadding="10">
<tr>
    <th>Judul</th>
    <th>ISBN</th>
    <th>Penulis</th>
    <th>Stok</th>
</tr>
@foreach($bukus as $b)
<tr>
    <td>{{ $b->judul }}</td>
    <td>{{ $b->isbn }}</td>
    <td>{{ $b->penulis }}</td>
    <td>{{ $b->stok }}</td>
</tr>
@endforeach
</table>

<br>

<h3>Peminjaman</h3>
<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>ID</th>
    <th>Judul Buku</th>
    <th>ISBN</th>
    <th>Tanggal Pinjam</th>
</tr>
@foreach($peminjaman as $p)
<tr>
    <td>{{ $p->user->name }}</td>
    <td>{{ explode('@', $p->user->email)[0] }}</td>
    <td>{{ $p->buku->judul ?? '-' }}</td>
    <td>{{ $p->buku->isbn ?? '-' }}</td>
    <td>{{ $p->tanggal_pinjam }}</td>
</tr>
@endforeach
</table>

<br>

<h3>Pengembalian</h3>
<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>ID</th>
    <th>Judul Buku</th>
    <th>ISBN</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
</tr>
@foreach($pengembalian as $p)
<tr>
    <td>{{ $p->user->name }}</td>
    <td>{{ explode('@', $p->user->email)[0] }}</td>
    <td>{{ $p->buku->judul ?? '-' }}</td>
    <td>{{ $p->buku->isbn ?? '-' }}</td>
    <td>{{ $p->tanggal_kembali }}</td>
    <td>
    @if($p->denda)
        @if($p->denda->status == 'lunas')
            Lunas
        @else
            Belum Lunas
        @endif
    @else
        Tidak Ada Denda
    @endif
</td>
</tr>
@endforeach
</table>

<br>

<h3>Denda</h3>

@php $total = 0; @endphp

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>ID</th>
    <th>Total Denda</th>
</tr>

@foreach($denda as $d)
<tr>
    <td>{{ $d->user->name }}</td>
    <td>{{ explode('@', $d->user->email)[0] }}</td>
    <td>Rp {{ $d->total_denda }}</td>
</tr>

@php $total += $d->total_denda; @endphp
@endforeach

<tr>
    <td colspan="2"><b>Total Keseluruhan</b></td>
    <td><b>Rp {{ $total }}</b></td>
</tr>
</table>

@foreach($denda as $d)
<tr>
    <td>{{ $d->user->name }}</td>
    <td>{{ explode('@', $d->user->email)[0] }}</td>
    <td>{{ $d->peminjaman->buku->judul ?? '-' }}</td>
    <td>{{ $d->peminjaman->buku->isbn ?? '-' }}</td>
    <td>Rp {{ $d->total_denda }}</td>
</tr>
@endforeach
</table>

@elseif($jenis == 'buku')

<h2>Laporan Buku</h2>
<table border="1" cellpadding="10">
<tr>
    <th>Judul</th>
    <th>ISBN</th>
    <th>Penulis</th>
    <th>Stok</th>
</tr>
@foreach($data as $b)
<tr>
    <td>{{ $b->judul }}</td>
    <td>{{ $b->isbn }}</td>
    <td>{{ $b->penulis }}</td>
    <td>{{ $b->stok }}</td>
</tr>
@endforeach
</table>

@elseif($jenis == 'peminjaman')

<h2>Laporan Peminjaman</h2>
<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>ID</th>
    <th>Judul Buku</th>
    <th>ISBN</th>
    <th>Tanggal Pinjam</th>
</tr>
@foreach($data as $p)
<tr>
    <td>{{ $p->user->name }}</td>
    <td>{{ explode('@', $p->user->email)[0] }}</td>
    <td>{{ $p->buku->judul ?? '-' }}</td>
    <td>{{ $p->buku->isbn ?? '-' }}</td>
    <td>{{ $p->tanggal_pinjam }}</td>
</tr>
@endforeach
</table>

@elseif($jenis == 'pengembalian')

<h2>Laporan Pengembalian</h2>
<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>ID</th>
    <th>Judul Buku</th>
    <th>ISBN</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
</tr>

@foreach($data as $p)
<tr>
    <td>{{ $p->user->name }}</td>
    <td>{{ explode('@', $p->user->email)[0] }}</td>
    <td>{{ $p->buku->judul ?? '-' }}</td>
    <td>{{ $p->buku->isbn ?? '-' }}</td>
    <td>{{ $p->tanggal_kembali }}</td>

    <!-- TAMBAH INI -->
    <td>
        @if($p->denda)
            @if($p->denda->status == 'lunas')
                Lunas
            @else
                Belum Lunas
            @endif
        @else
            Tidak Ada Denda
        @endif
    </td>

</tr>
@endforeach
</table>

@elseif($jenis == 'denda')

<h2>Laporan Denda</h2>

@php $total = 0; @endphp

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>ID</th>
    <th>Total Denda</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->user->name }}</td>
    <td>{{ explode('@', $d->user->email)[0] }}</td>
    <td>Rp {{ $d->total_denda }}</td>
</tr>

@php $total += $d->total_denda; @endphp
@endforeach

<tr>
    <td colspan="2"><b>Total Keseluruhan</b></td>
    <td><b>Rp {{ $total }}</b></td>
</tr>
</table>

@endif

<br><br>
<button onclick="window.print()">🖨️ Cetak</button>

@endif
