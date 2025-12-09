<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'report_date',
        'total_bookings',
        'total_success_transactions',
        'total_income',
        'notes'
    ];
}
