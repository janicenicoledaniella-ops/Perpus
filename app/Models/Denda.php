<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $fillable = [
        'user_id',
        'peminjaman_id',
        'jumlah_hari_terlambat',
        'total_denda',
        'status'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function index()
{
    $denda = Denda::with('peminjaman.buku')
        ->where('user_id', auth()->id())
        ->where('status', 'belum_bayar')
        ->get();

    return view('denda.index', compact('denda'));
}

public function bayar(Request $request)
{
    Denda::where('user_id', auth()->id())
        ->where('status', 'belum_bayar')
        ->update(['status' => 'lunas']);

    return redirect()->route('dashboard')->with('success', 'Pembayaran selesai');
}
}
