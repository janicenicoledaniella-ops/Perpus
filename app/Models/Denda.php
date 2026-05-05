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

    public function peminjaman()
{
    return $this->belongsTo(\App\Models\Peminjaman::class);
}

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}