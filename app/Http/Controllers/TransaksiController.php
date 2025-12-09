<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua transaksi dengan relasi booking, user, dan room
        // Asumsi relasi booking sudah ada di Transaksi model
        $transactions = Transaksi::with('booking.user', 'booking.room')
                            ->orderBy('transaction_date', 'desc')
                            ->paginate(10);
                            
        return view('transaksi.index', compact('transactions'));
    }

    /**
     * Remove the specified resource from storage.
     * Hanya boleh dilakukan oleh admin.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil dihapus.');
    }
    
    // Metode create, store, edit, update biasanya dihandle oleh sistem payment gateway/booking process.
}
