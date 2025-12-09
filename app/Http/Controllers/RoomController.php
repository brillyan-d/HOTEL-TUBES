<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('kamar.index', compact('rooms'));
    }

    // Tambahkan publicIndex Method ini ke dalam class RoomController

    /**
     * Display the public listing of available rooms with filters.
     */
    public function publicIndex(Request $request)
    {
        $query = Room::where('stok', '>', 0); // Hanya tampilkan kamar yang punya stok

        // Filter berdasarkan Tipe Kamar
        if ($request->filled('type')) {
            $query->where('tipe_kamar', $request->input('type'));
        }
        
        // Filter berdasarkan Guests (Simulasi sederhana)
        if ($request->filled('guests')) {
             // Asumsi: Single = 1-2, Double = 2-3, Suite = 3+
            // Implementasi di sini mungkin perlu penyesuaian dengan logika bisnis kamu
        }


        // Filter ketersediaan berdasarkan tanggal (Logika sederhana: Cek ketersediaan berdasarkan booking)
        if ($request->filled(['check_in', 'check_out']) && $request->check_in < $request->check_out) {
            $checkIn = $request->input('check_in');
            $checkOut = $request->input('check_out');

            // Logic: Ambil rooms.id yang TIDAK ada di daftar Booking yang bentrok dengan tanggal yang diminta.
            $bookedRoomIds = Booking::where(function ($q) use ($checkIn, $checkOut) {
                // Bentrok jika: 
                // 1. Check-in/Check-out ada di antara tanggal request
                $q->whereBetween('check_in_date', [$checkIn, $checkOut])
                  ->orWhereBetween('check_out_date', [$checkIn, $checkOut])
                  // 2. Tanggal request ada di antara Check-in/Check-out yang sudah ada
                  ->orWhere(function ($q2) use ($checkIn, $checkOut) {
                      $q2->where('check_in_date', '<', $checkIn)
                         ->where('check_out_date', '>', $checkOut);
                  });
            })
            // Hanya booking yang Confirmed atau Checked_in
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->pluck('room_id')
            ->unique();

            // Kecualikan kamar yang sudah dibooking pada periode tersebut
            $query->whereNotIn('id', $bookedRoomIds);
        }
        
        $rooms = $query->latest()->paginate(9);

        return view('rooms.index', compact('rooms'));
    }
    
    /**
     * Metode placeholder untuk proses booking per kamar.
     */
    public function book($id)
    {
        $room = Room::findOrFail($id);
        // Di sini kamu akan mengarahkan ke halaman booking form
        // return view('rooms.book', compact('room'));
        // Untuk saat ini, kita redirect sementara
        return redirect()->back()->with('error', 'Fitur Booking Form belum diimplementasikan!');
    }

// ... sisa class RoomController

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Wajib!)
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'tipe_kamar' => 'required|string|max:50',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $data = $request->all();

        // 2. Proses Upload Gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('rooms', 'public');
        }

        // 3. Simpan data ke database
        Room::create($data);

        return redirect()->route('kamar.index')
                         ->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $kamar)
    {
        // Metode ini jarang digunakan di Admin CRUD, tetapi tetap bisa disediakan jika perlu
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $kamar)
    {
        // Variabel yang dipassing di view sudah di-binding otomatis sebagai $kamar
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $kamar)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'tipe_kamar' => 'required|string|max:50',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // 2. Proses Update Gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kamar->gambar) {
                Storage::disk('public')->delete($kamar->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('rooms', 'public');
        }

        // 3. Perbarui data di database
        $kamar->update($data);

        return redirect()->route('kamar.index')
                         ->with('success', 'Detail kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $kamar)
    {
        // Hapus gambar dari storage
        if ($kamar->gambar) {
            Storage::disk('public')->delete($kamar->gambar);
        }

        // Hapus record kamar
        $kamar->delete();

        return redirect()->route('kamar.index')
                         ->with('success', 'Kamar berhasil dihapus.');
    }
}
