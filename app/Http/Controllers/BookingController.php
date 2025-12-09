<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Tampilkan semua booking
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])->orderBy('id', 'desc')->get();
        return view('bookings.index', compact('bookings'));
    }

    // Form tambah booking
    public function create()
    {
        $users = User::all();
        $rooms = Room::where('status', 'available')->get();

        return view('bookings.create', compact('users', 'rooms'));
    }

    // Simpan booking
    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => 'required',
            'room_id'   => 'required',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guest_count' => 'required|numeric|min:1'
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat.');
    }

    // Form edit booking
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $users = User::all();
        $rooms = Room::all();

        return view('bookings.edit', compact('booking', 'users', 'rooms'));
    }

    // Update data booking
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'   => 'required',
            'room_id'   => 'required',
            'check_in'  => 'required',
            'check_out' => 'required|date|after:check_in',
            'guest_count' => 'required'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    // Hapus booking
    public function destroy($id)
    {
        Booking::destroy($id);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
