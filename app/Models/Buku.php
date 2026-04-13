<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
     use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'isbn',
        'kategori',
        'stok',
        'deskripsi',
        'cover'
    ];
     public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id', 'isbn');
    }
    protected $primaryKey = 'isbn';
public $incrementing = false;
protected $keyType = 'string';
}
