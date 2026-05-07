@extends('layouts.app')

@section('content')
<div style="max-width:1100px;margin:auto;">

<div class="max-w-5xl mx-auto py-6">

   
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

<h2 style="margin-bottom:20px;font-size:24px;font-weight:bold;">
    Kelola Peminjaman
</h2>

{{-- DROPDOWN --}}
<select id="menu" class="border rounded px-4 py-2 mb-6 w-64">
    <option value="booking">Booking Buku</option>
    <option value="peminjaman">Peminjaman</option>
</select>

{{-- ================= BOOKING ================= --}}
<div id="booking-section" class="hidden">

    <h2 class="text-xl font-semibold mb-3">Booking Buku</h2>

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

    <div class="bg-white shadow rounded p-4">
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nama</th>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>ISBN</th>
                    <th>Tanggal Ambil</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($booking as $b)
                <tr class="text-center border-t">
                    <td>{{ $b->user->name }}</td>
                    <td>{{ $b->user->id }}</td>
                    <td>{{ $b->buku->judul }}</td>
                    <td>{{ $b->buku->isbn }}</td>
                    <td>{{ $b->tanggal_booking }}</td>
                    <td>
                        @if($b->status == 'booking')
                            <form action="{{ route('admin.ambil', $b->id) }}" method="POST">
                                @csrf
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                    Ambil Buku
                                </button>
                            </form>
                        @else
                            <button class="bg-green-500 text-white px-3 py-1 rounded cursor-not-allowed">
                                Buku Telah Diambil
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-3">
                        Tidak ada booking
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>


{{-- ================= PEMINJAMAN ================= --}}
<div id="peminjaman-section" class="hidden">

    <h2 class="text-xl font-semibold mb-3">Buku Sedang Dipinjam</h2>

   
    <div class="mb-4 flex gap-3">
        <button onclick="showPinjam()" 
            class="bg-blue-500 text-white px-4 py-2 rounded">
            Pinjam Buku
        </button>

        <button onclick="showTabel()" 
            class="bg-gray-600 text-white px-4 py-2 rounded">
            Lihat Semua
        </button>
    </div>

    <div id="formPinjam" class="hidden bg-white p-6 rounded shadow mb-4 max-w-4xl">

        <h3 class="text-xl font-bold mb-3">Peminjaman</h3>

        <form action="{{ route('admin.peminjaman.manual') }}" method="POST">
            @csrf

            <div class="mb-3">
    <label class="block mb-1">Judul Buku</label>

    <select name="buku_id" class="border w-96 p-2 rounded">
        @foreach($bukus as $b)
            <option value="{{ $b->isbn }}">
                {{ $b->judul }}
            </option>
        @endforeach
    </select>
</div>

            <div class="mb-3">
    <label class="block mb-1">ID</label>
    <input type="text" name="user_id" class="border w-96 p-2 rounded" required>
</div>

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Pinjam
            </button>
        </form>

    </div>

   
    <div id="tabelPeminjaman" class="hidden bg-white shadow rounded p-4">
        <table class="w-full border">
            <thead class="bg-gray-100">
    <tr>
        <th class="p-2">Nama</th>
        <th>Judul Buku</th>
        <th>ISBN</th>
        <th>Tanggal Pinjam</th> {{-- ✅ TAMBAH INI --}}
        <th>Jatuh Tempo</th>
    </tr>
</thead>

            <tbody>
            @forelse($peminjaman as $item)
                <tr class="text-center border-t">
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->buku->judul }}</td>
                    <td>{{ $item->buku->isbn }}</td>
                    <td>
    {{ $item->tanggal_pinjam 
        ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') 
        : '-' 
    }}
</td>

<td>
    {{ $item->tanggal_jatuh_tempo 
        ? \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') 
        : '-' 
    }}
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-3">
                        Tidak ada peminjaman
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

</div>

{{-- SCRIPT --}}
<script>
let menu = document.getElementById('menu');
let booking = document.getElementById('booking-section');
let peminjaman = document.getElementById('peminjaman-section');

// default tampil booking
window.onload = function() {
    let active = "{{ session('active_tab') }}";

    if (active === 'peminjaman') {
        menu.value = 'peminjaman';
        peminjaman.classList.remove('hidden');
    } else {
        menu.value = 'booking';
        booking.classList.remove('hidden');
    }
};

menu.addEventListener('change', function () {
    booking.classList.add('hidden');
    peminjaman.classList.add('hidden');

    if (this.value === 'booking') {
        booking.classList.remove('hidden');
    }

    if (this.value === 'peminjaman') {
        peminjaman.classList.remove('hidden');
    }
});


function showPinjam() {
    document.getElementById('formPinjam').classList.remove('hidden');
    document.getElementById('tabelPeminjaman').classList.add('hidden');
}

function showTabel() {
    document.getElementById('tabelPeminjaman').classList.remove('hidden');
    document.getElementById('formPinjam').classList.add('hidden');
}
</script>

@endsection