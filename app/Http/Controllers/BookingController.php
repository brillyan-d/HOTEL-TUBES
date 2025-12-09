<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // =========================================================
    // Admin Management Methods (Index & Update Status)
    // =========================================================
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])
                            ->orderBy('check_in_date', 'desc')
                            ->paginate(10); 
                            
        return view('admin.booking.index', compact('bookings'));
    }

    public function edit(Booking $booking)
    {
        return view('admin.booking.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,canceled',
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->route('booking.index')
                         ->with('success', 'Status booking berhasil diperbarui!');
    }

    public function destroy(Booking $booking) 
    {
        $booking->delete();
        return redirect()->route('booking.index')
                         ->with('success', 'Booking berhasil dihapus.');
    }
    
    // =========================================================
    // Public User Store Method
    // =========================================================

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'room_id'           => 'required|exists:rooms,id',
            'check_in_date'     => 'required|date|after_or_equal:today',
            'check_out_date'    => 'required|date|after:check_in_date',
            'guest_count'       => 'required|numeric|min:1'
        ]);
        
        $room = Room::findOrFail($request->room_id);
        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $nightCount = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->harga * $nightCount;

        // 2. Cek Ketersediaan Kamar
        // Query untuk cek apakah ada kamar yang sudah dibooking (confirmed/pending) di range tanggal ini
        $bookedCount = Booking::where('room_id', $request->room_id)
            ->whereIn('status', ['confirmed', 'checked_in', 'pending'])
            ->where(function ($q) use ($checkIn, $checkOut) {
                $q->whereBetween('check_in_date', [$checkIn, $checkOut->copy()->subDay(1)])
                  ->orWhereBetween('check_out_date', [$checkIn->copy()->addDay(1), $checkOut])
                  ->orWhere(function ($q2) use ($checkIn, $checkOut) {
                      $q2->where('check_in_date', '<', $checkIn)
                         ->where('check_out_date', '>', $checkOut);
                  });
            })
            ->count();

        if ($bookedCount >= $room->stok) {
            return redirect()->back()->withInput()->with('error', 'Maaf, kamar ini sudah penuh untuk tanggal yang Anda pilih.');
        }

        // 3. Simpan Booking Baru
        Booking::create([
            'user_id'       => Auth::id(), // Ambil ID user yang sedang login
            'room_id'       => $room->id,
            'check_in_date' => $checkIn,
            'check_out_date'=> $checkOut,
            'total_price'   => $totalPrice,
            'guest_count'   => $request->guest_count,
            'status'        => 'pending', // Default status awal
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }
    
    // Metode create, edit, update lain dihapus karena Admin Edit sudah di atas.
}
