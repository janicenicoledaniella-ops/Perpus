<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // 🔹 Tampilkan booking user
    public function index()
    {
        $booking = Booking::with(['buku','user'])->get();

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