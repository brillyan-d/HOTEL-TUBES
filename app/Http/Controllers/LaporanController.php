<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Menampilkan formulir laporan dan hasil laporan berdasarkan filter.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $reports = collect();
        $totalRevenue = 0;
        $totalBookings = 0;

        if ($startDate && $endDate) {
            
            // 1. Validasi Tanggal
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            // 2. Ambil Transaksi yang sudah PAID (dan yang dibooking)
            $reports = Transaksi::with(['booking.user', 'booking.room'])
                ->where('status', 'paid')
                ->whereBetween('transaction_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                ->orderBy('transaction_date', 'asc')
                ->get();
            
            // 3. Hitung Ringkasan
            $totalRevenue = $reports->sum('amount');
            $totalBookings = $reports->count();
        }

        return view('laporan.index', compact('reports', 'startDate', 'endDate', 'totalRevenue', 'totalBookings'));
    }

    /**
     * Membuat Laporan PDF (Placeholder - Fitur Ekstra)
     */
    public function generatePdf(Request $request)
    {
        // Fitur ini memerlukan library seperti barryvdh/laravel-dompdf
        // Untuk sekarang, kita kembalikan redirect saja.
        return redirect()->route('laporan.index')->with('info', 'Fitur generate PDF belum terinstal.');
    }
}
