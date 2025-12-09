<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil data Ringkasan (KPIs)
        $totalRooms = Room::count();
        $totalUsers = User::count();
        $totalBookings = Booking::count();
        $totalRevenue = Transaksi::where('status', 'paid')->sum('amount');
        
        // 2. Ambil Booking Terbaru
        $latestBookings = Booking::with('user', 'room')->latest()->take(5)->get();
        
        // 3. Ambil Kamar dengan Stok Paling Rendah (untuk peringatan)
        $lowStockRooms = Room::orderBy('stok', 'asc')->take(3)->get();

        return view('admin.admin', compact(
            'totalRooms',
            'totalUsers',
            'totalBookings',
            'totalRevenue',
            'latestBookings',
            'lowStockRooms'
        ));
    }
}
