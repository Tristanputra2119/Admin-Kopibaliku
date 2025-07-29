<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kopi extends Model
{
    protected $table = 'kopi';

    protected $fillable = [
        'nama_kopi', 'jenis_kopi', 'stok', 'harga',
        'deskripsi', 'gambar'
    ];
}
