<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_kembali',
        'status'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'isbn');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function denda()
    {
    return $this->hasOne(Denda::class);
    }
}