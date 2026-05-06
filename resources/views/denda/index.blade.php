@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-6">

    <h2 class="text-2xl font-bold mb-5">
        Denda
    </h2>

    {{-- ❗ CEK ADA DENDA ATAU TIDAK --}}
    @if($dendas->isEmpty())

        <div class="p-6 bg-gray-100 rounded-lg text-center">
            <h3 class="text-green-600 font-bold text-lg mt-10">
                Anda tidak memiliki denda
            </h3>
        </div>

    @else

    <div class="bg-white shadow-md rounded-xl overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3">Judul</th>
                        <th class="px-6 py-3">ISBN</th>
                        <th class="px-6 py-3">Hari Telat</th>
                        <th class="px-6 py-3">Total Denda</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                @php $totalSemua = 0; @endphp

                @foreach($dendas as $item)

                    @php
                        $p = $item->peminjaman;

                        $jatuhTempo = \Carbon\Carbon::parse($p->tanggal_jatuh_tempo)->startOfDay();
                        $kembali    = \Carbon\Carbon::parse($p->tanggal_kembali)->startOfDay();

                        $hari = 0;

                        if ($kembali->gt($jatuhTempo)) {
                            $hari = $jatuhTempo->diffInDays($kembali);
                            if ($hari == 0) $hari = 1;
                        }

                        $denda = max(0, $item->total_denda);
                        $totalSemua += $denda;
                    @endphp

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $p->buku->judul ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $p->buku->isbn ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                {{ $hari }} hari
                            </span>
                        </td>

                        <td class="px-6 py-4 font-semibold text-red-600">
                            Rp {{ number_format($denda) }}
                        </td>

                        <td class="px-6 py-4">
                            @if($item->status == 'lunas')
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Lunas
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                    Belum
                                </span>
                            @endif
                        </td>

                    </tr>

                @endforeach

                </tbody>

                <tfoot class="bg-gray-100 font-bold">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right">Total</td>
                        <td class="px-6 py-4 text-red-600">
                            Rp {{ number_format($totalSemua) }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>

    {{-- 🔘 BUTTON BAYAR --}}
    @if($totalSemua > 0)
    <form action="{{ route('denda.bayar', $dendas->first()->id) }}" method="POST" class="mt-6">
        @csrf
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
            Bayar Sekarang
        </button>
    </form>
    @endif

    @endif

</div>

@endsection