<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::orderBy('report_date', 'desc')->get();
        return view('laporans.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'report_date' => 'required|date',
            'total_bookings' => 'required|integer',
            'total_success_transactions' => 'required|integer',
            'total_income' => 'required|numeric',
        ]);

        Laporan::create($request->all());

        return redirect()->route('laporans.index')
            ->with('success', 'Laporan berhasil dibuat');
    }

    public function edit(Laporan $laporan)
    {
        return view('laporans.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'report_date' => 'required|date',
            'total_bookings' => 'required|integer',
            'total_success_transactions' => 'required|integer',
            'total_income' => 'required|numeric',
        ]);

        $laporan->update($request->all());

        return redirect()->route('laporans.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(Laporan $laporan)
    {
        $laporan->delete();

        return redirect()->route('laporans.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}
