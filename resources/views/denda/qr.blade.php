@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white p-6 rounded-xl shadow-lg text-center">

        <h2 class="text-xl font-semibold mb-2">
            QR Pembayaran Denda
        </h2>

        <p class="mb-2">Silakan scan QR untuk membayar denda</p>

        <p class="mb-4 font-bold">
            Total: Rp {{ number_format($denda->total_denda) }}
        </p>

        <img 
            class="mx-auto border p-2 rounded mb-4"
            src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PEMBAYARAN_DENDA"
        >

        <p class="text-gray-500">Memproses pembayaran...</p>

    </div>

</div>

<script>
    setTimeout(function() {
        window.location.href = "{{ route('denda.selesai', $denda->id) }}";
    }, 5000);
</script>

@endsection