<?php

namespace App\Http\Controllers;

use App\Models\Room; // Mengganti Kamar menjadi Room untuk konsistensi
use App\Models\Booking; // Tambahkan ini untuk cek ketersediaan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KamarController extends Controller
{
    // =========================================================
    // Admin CRUD Methods
    // =========================================================

    public function index()
    {
        // Menggunakan Room Model untuk konsistensi
        $rooms = Room::latest()->paginate(10);
        return view('kamar.index', compact('rooms'));
    }

    public function create()
    {
        return view('kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'tipe_kamar' => 'required|string|max:50',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('_token');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()->route('kamar.index')
                         ->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function edit(Room $kamar)
    {
        return view('kamar.edit', ['room' => $kamar]);
    }

    public function update(Request $request, Room $kamar)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'tipe_kamar' => 'required|string|max:50',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('_token', '_method');

        if ($request->hasFile('gambar')) {
            if ($kamar->gambar) {
                Storage::disk('public')->delete($kamar->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('rooms', 'public');
        }

        $kamar->update($data);

        return redirect()->route('kamar.index')
                         ->with('success', 'Detail kamar berhasil diperbarui!');
    }

    public function destroy(Room $kamar)
    {
        if ($kamar->gambar) {
            Storage::disk('public')->delete($kamar->gambar);
        }
        $kamar->delete();

        return redirect()->route('kamar.index')
                         ->with('success', 'Kamar berhasil dihapus.');
    }
    
    // =========================================================
    // Public Booking Methods (Menggantikan RoomController sebelumnya)
    // =========================================================
    
    public function publicIndex(Request $request)
    {
        $query = Room::where('stok', '>', 0); 
        
        // Filter Type dan Guests
        if ($request->filled('type')) { $query->where('tipe_kamar', $request->input('type')); }
        
        // Filter ketersediaan berdasarkan tanggal
        if ($request->filled(['check_in', 'check_out']) && $request->check_in < $request->check_out) {
            $checkIn = $request->input('check_in');
            $checkOut = $request->input('check_out');

            $bookedRoomIds = Booking::where(function ($q) use ($checkIn, $checkOut) {
                $q->whereBetween('check_in_date', [$checkIn, $checkOut])
                  ->orWhereBetween('check_out_date', [$checkIn, $checkOut])
                  ->orWhere(function ($q2) use ($checkIn, $checkOut) {
                      $q2->where('check_in_date', '<', $checkIn)
                         ->where('check_out_date', '>', $checkOut);
                  });
            })
            ->whereIn('status', ['confirmed', 'checked_in', 'pending'])
            ->pluck('room_id')
            ->unique();

            $query->whereNotIn('id', $bookedRoomIds);
        }
        
        $rooms = $query->latest()->paginate(9);

        return view('rooms.index', compact('rooms'));
    }
    
    public function book(Room $room)
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan login untuk melanjutkan pemesanan.');
        }

        // Langsung tampilkan form booking
        return view('rooms.book', compact('room'));
    }

}
