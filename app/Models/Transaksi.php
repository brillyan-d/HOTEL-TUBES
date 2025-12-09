<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    
    // Sesuaikan dengan kolom migrasi transaksi-mu
    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'transaction_code',
        'transaction_date',
        'status', // e.g., pending, paid, failed
    ];

    /**
     * Relasi ke model Booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
