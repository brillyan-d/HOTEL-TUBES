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
