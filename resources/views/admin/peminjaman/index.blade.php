@extends('layouts.app')

@section('content')
<div style="max-width:1100px;margin:auto;">

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

    {{-- ALERT --}}
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
                        <form action="{{ route('admin.ambil', $b->id) }}" method="POST">
                            @csrf
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                Ambil Buku
                            </button>
                        </form>
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

    <div class="bg-white shadow rounded p-4">
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nama</th>
                    <th>Judul Buku</th>
                    <th>ISBN</th>
                    <th>Jatuh Tempo</th>
                </tr>
            </thead>

            <tbody>
            @forelse($peminjaman as $item)
                <tr class="text-center border-t">
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->buku->judul }}</td>
                    <td>{{ $item->buku->isbn }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo }}</td>
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
    menu.value = 'booking';
    booking.classList.remove('hidden');
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
</script>

@endsection