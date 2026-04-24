<div style="display:flex;justify-content:center;align-items:center;height:100vh;text-align:center;flex-direction:column;">

    <h2>Scan QR untuk Membayar</h2>

    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PEMBAYARAN_DENDA"
         style="margin:20px 0;">

    <p>Scan QR Code berikut untuk membayar denda</p>

</div>

<script>
setTimeout(function(){
    window.location.href = "{{ route('denda.selesai') }}";
}, 5000);
</script>