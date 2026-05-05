<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Peminjaman; 

class BookingController extends Controller
{

public function index()
{
    $booking = Peminjaman::with('buku')
        ->where('user_id', auth()->id())
        ->where('status', 'booking') // ⛔ INI KUNCI
        ->latest()
        ->get();

    return view('booking.index', compact('booking'));
}

    public function store($buku_id)
{
    Booking::create([
        'user_id' => auth()->id(),
        'buku_id' => $buku_id,
        'tanggal_booking' => now(),
        'status' => 'menunggu'
    ]);

    return back()->with('success', 'Berhasil booking');
}
}