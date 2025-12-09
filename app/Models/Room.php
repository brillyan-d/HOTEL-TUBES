<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    // Pastikan semua field dari form sudah ada di sini, termasuk 'gambar'
    protected $fillable = [
        'nama_kamar', 
        'tipe_kamar', 
        'harga', 
        'deskripsi', 
        'stok', 
        'gambar'
    ];
}
