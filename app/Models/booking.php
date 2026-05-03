<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_booking',
        'status'
    ];

    // relasi ke buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}