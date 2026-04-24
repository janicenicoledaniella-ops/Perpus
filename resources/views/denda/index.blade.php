<h2>Daftar Denda</h2>

@if($dendas->isEmpty())

    {{-- ❌ TIDAK ADA DENDA --}}
    <p style="color:green; font-weight:bold;">
        Anda tidak memiliki denda
    </p>

    <a href="{{ route('dashboard') }}">
        <button style="margin-top:10px; padding:8px 15px;">
            Kembali ke Dashboard
        </button>
    </a>

@else

    {{-- ✅ ADA DENDA --}}
    <table border="1" cellpadding="10">
    <tr>
        <th>Judul Buku</th>
        <th>ISBN</th>
        <th>Telat (hari)</th>
        <th>Total Denda</th>
    </tr>

    @foreach($dendas as $d)
    <tr>
        <td>{{ $d->peminjaman->buku->judul ?? '-' }}</td>
        <td>{{ $d->peminjaman->buku->isbn ?? '-' }}</td>
        <td>{{ $d->jumlah_hari_terlambat }}</td>
        <td>Rp {{ $d->total_denda }}</td>
    </tr>
    @endforeach
    </table>

    <br>

    <form action="{{ route('denda.bayar') }}" method="POST">
        @csrf
        <button style="background:red;color:white;padding:10px;">
            Bayar Denda
        </button>
    </form>

@endif