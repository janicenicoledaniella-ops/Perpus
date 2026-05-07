<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Peminjaman; 
use Illuminate\Support\Facades\Auth;
class BookingController extends Controller
{

public function index()
{
    $booking = Peminjaman::with('buku')
        ->where('user_id',  Auth::id())
        ->where('status', 'booking') 
        ->latest()
        ->get();

    return view('booking.index', compact('booking'));
}

    public function store(string $buku_id)
{
    Booking::create([
        'user_id' =>  Auth::id(),
        'buku_id' => $buku_id,
        'tanggal_booking' => now(),
        'status' => 'menunggu'
    ]);

    return back()->with('success', 'Berhasil booking');
}

}