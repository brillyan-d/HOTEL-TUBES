<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room; // Digunakan untuk relasi
use App\Models\User; // Digunakan untuk relasi
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua booking dengan detail user dan room, urutkan berdasarkan tanggal check-in
        $bookings = Booking::with(['user', 'room'])
                            ->orderBy('check_in_date', 'desc')
                            ->paginate(10); 
                            
        return view('admin.booking.index', compact('bookings'));
    }

    /**
     * Show the form for editing the specified resource (Hanya untuk ubah status di Admin).
     */
    public function edit(Booking $booking)
    {
        // Dengan Route Model Binding, $booking sudah terisi data
        return view('admin.booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage (Update Status Booking).
     */
    public function update(Request $request, Booking $booking)
    {
        // Validasi hanya status yang boleh diubah
        $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,canceled',
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->route('booking.index')
                         ->with('success', 'Status booking berhasil diperbarui!');
    }

    // Metode create, store, show, dan destroy biasanya tidak diperlukan atau dihandle di sisi User/Frontend
    public function create() { /* No Admin Create Form needed */ }
    public function store(Request $request) { /* Bookings are created by users */ }
    public function show(Booking $booking) { /* Basic view */ }
    public function destroy(Booking $booking) 
    {
        $booking->delete();
        return redirect()->route('booking.index')
                         ->with('success', 'Booking berhasil dihapus.');
    }
}
