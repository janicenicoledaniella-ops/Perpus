<h2>Daftar Denda</h2>

@foreach($dendas as $denda)
    <p>
        Terlambat: {{ $denda->jumlah_hari_terlambat }} hari |
        Total: Rp {{ $denda->total_denda }} |
        Status: {{ $denda->status }}

        @if($denda->status == 'belum_bayar')
        <form action="/denda/{{ $denda->id }}/bayar" method="POST">
            @csrf
            <button type="submit">Bayar</button>
        </form>
        @endif
    </p>
@endforeach