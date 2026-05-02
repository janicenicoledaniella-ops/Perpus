@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <h1 class="text-2xl font-bold mb-4">Kelola Peminjaman</h1>

    {{-- DROPDOWN --}}
    <select id="menu" class="border rounded px-4 py-2 mb-6 w-64">
    <option value="booking">Booking Buku</option>
    <option value="peminjaman">Peminjaman</option>
</select>

    {{-- ================= BOOKING ================= --}}
    <div id="booking-section" class="hidden">

    <h2 class="text-xl font-semibold mb-3">Booking Buku</h2>

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
                @foreach($booking as $b)
                <tr id="row-{{ $b->id }}" class="text-center border-t">
                    <td>{{ $b->user->name }}</td>
                    <td>{{ $b->user->id }}</td>
                    <td>{{ $b->buku->judul }}</td>
                    <td>{{ $b->buku->isbn }}</td>
                    <td>{{ $b->tanggal_booking }}</td>
                    <td>
                        <button onclick="ambil({{ $b->id }})"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                        Ambil Buku
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

    {{-- ================= PEMINJAMAN ================= --}}
    <div id="peminjaman-section" class="hidden">

    <h2 class="text-xl font-semibold mb-4">Peminjaman</h2>

    <div class="bg-white shadow rounded p-6 w-fit">

        <form method="POST" action="{{ route('peminjaman.pinjamManual') }}">
            @csrf

            {{-- JUDUL --}}
            <label class="font-bold block mb-1">Judul</label>
            <select name="buku_id" class="border rounded p-2 w-72 mb-4">
                @foreach($bukus as $b)
                    <option value="{{ $b->isbn }}">{{ $b->judul }}</option>
                @endforeach
            </select>

            {{-- ID --}}
            <label class="font-bold block mb-1">ID (NIM/NIDN)</label>
            <input type="text" name="user_id"
                class="border rounded p-2 w-72 mb-4"
                placeholder="Masukkan ID">

            {{-- BUTTON --}}
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Pinjam
            </button>

        </form>

    </div>

</div>



{{-- SCRIPT --}}
<script>
let menu = document.getElementById('menu');
let booking = document.getElementById('booking-section');
let peminjaman = document.getElementById('peminjaman-section');

// default kosong
booking.classList.add('hidden');
peminjaman.classList.add('hidden');

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

function ambil(id) {
    fetch('/admin/ambil/' + id, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(() => {
        let row = document.getElementById('row-' + id);
        let btn = row.querySelector('button');

        btn.innerText = "Sudah Diambil";
        btn.classList.remove('bg-blue-500');
        btn.classList.add('bg-green-500');

        row.style.background = '#d4edda';

        setTimeout(() => {
            row.remove();
        }, 3000);
    });
}
</script>

@endsection