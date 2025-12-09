<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Booking;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('booking')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $bookings = Booking::all();
        return view('transactions.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric'
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')
                         ->with('success', 'Transaksi berhasil dibuat');
    }

    public function edit(Transaction $transaction)
    {
        $bookings = Booking::all();
        return view('transactions.edit', compact('transaction', 'bookings'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'booking_id' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required'
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
                         ->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')
                         ->with('success', 'Transaksi berhasil dihapus');
    }
}
