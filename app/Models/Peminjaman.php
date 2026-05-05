<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; 
use Carbon\Carbon;

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
        return $this->hasOne(\App\Models\Denda::class);
    }
    
public function getDendaAttribute()
    {
        if (!$this->tanggal_jatuh_tempo) return 0;

        $jatuhTempo = Carbon::parse($this->tanggal_jatuh_tempo)->startOfDay();
        $sekarang   = now()->startOfDay();

        if ($sekarang->gt($jatuhTempo)) {
            $hari = $jatuhTempo->diffInDays($sekarang);
            return $hari * 1000;
        }

    return 0;
}
}