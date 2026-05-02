@extends('layouts.app')

@section('content')

<h2>QR Pembayaran Denda</h2>

<p>Silakan scan QR untuk membayar denda.</p>

<p>Total Denda: Rp {{ number_format($denda->total_denda) }}</p>

<img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PEMBAYARAN_DENDA"
         style="margin:20px 0;">
<p>Memproses pembayaran...</p>

<script>
    setTimeout(function() {
        window.location.href = "{{ route('denda.bayar', $denda->id) }}";
    }, 5000);
</script>

@endsection