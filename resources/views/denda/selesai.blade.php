<div style="
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    background:#f3f4f6;
    font-family:Arial, sans-serif;
">

    <div style="
        background:white;
        padding:40px;
        border-radius:15px;
        box-shadow:0 10px 25px rgba(0,0,0,0.1);
        text-align:center;
        width:350px;
        animation:fadeIn 0.5s ease-in-out;
    ">

        {{-- ICON CEKLIS --}}
        <div style="
            width:80px;
            height:80px;
            background:#22c55e;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:0 auto 20px;
            color:white;
            font-size:40px;
        ">
            ✔
        </div>

        <h1 style="
            color:#22c55e;
            font-size:26px;
            margin-bottom:10px;
        ">
            Pembayaran Berhasil
        </h1>

        <p style="
            color:#555;
            font-size:16px;
            margin-bottom:25px;
        ">
            Denda Anda sudah lunas
        </p>

        <a href="{{ route('dashboard') }}">
            <button style="
                background:#3b82f6;
                color:white;
                padding:12px 25px;
                border:none;
                border-radius:8px;
                font-size:15px;
                cursor:pointer;
                transition:0.3s;
            "
            onmouseover="this.style.background='#2563eb'"
            onmouseout="this.style.background='#3b82f6'">
                Kembali ke Dashboard
            </button>
        </a>

    </div>

</div>

<style>
@keyframes fadeIn {
    from {opacity:0; transform:translateY(20px);}
    to {opacity:1; transform:translateY(0);}
}
</style>