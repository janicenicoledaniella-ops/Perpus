<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';

    protected $primaryKey = 'isbn'; // ✅ WAJIB
    public $incrementing = false;   // ✅ WAJIB
    protected $keyType = 'string';  // ✅ WAJIB

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
}
