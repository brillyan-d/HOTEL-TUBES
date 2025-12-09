@extends('layout')

@section('page_title', 'Laporan Pendapatan Hotel')

@section('content')
<div class="container mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Laporan Pendapatan & Booking</h2>

    <div class="bg-white p-6 rounded-xl shadow-md mb-6">
        <form action="{{ route('laporan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div class="md:col-span-1">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                @error('start_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-1">
                <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input type="date" id="end_date" name="end_date" value="{{ $endDate }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                @error('end_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-1">
                <button type="submit" class="w-full px-5 py-3 text-sm font-semibold text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 transition duration-150">
                    Filter Laporan
                </button>
            </div>
            @if ($reports->isNotEmpty())
            <div class="md:col-span-1">
                <a href="{{ route('laporan.generate.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="w-full inline-block text-center px-5 py-3 text-sm font-semibold text-red-600 border border-red-600 rounded-lg shadow-md hover:bg-red-50 transition duration-150">
                    Cetak PDF
                </a>
            </div>
            @endif
        </form>
    </div>

    @if (session('info'))
        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg" role="alert">
            {{ session('info') }}
        </div>
    @endif

    @if ($reports->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-500">Total Pendapatan (PAID)</p>
            <p class="text-3xl font-extrabold text-green-600 mt-1">Rp. {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-yellow-500">
            <p class="text-sm font-medium text-gray-500">Total Booking PAID</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalBookings }}</p>
        </div>
    </div>
    
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tgl. Transaksi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Booking ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kamar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Bayar
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($reports as $transaksi)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($transaksi->transaction_date)->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">
                            #{{ $transaksi->booking_id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $transaksi->booking->room->nama_kamar ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transaksi->booking->user->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">
                            Rp. {{ number_format($transaksi->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @elseif ($startDate && $endDate)
        <div class="p-8 text-center bg-white rounded-xl shadow-md">
            <p class="text-xl text-gray-500">Tidak ada transaksi PAID dalam rentang tanggal tersebut.</p>
        </div>
    @else
        <div class="p-8 text-center bg-white rounded-xl shadow-md">
            <p class="text-xl text-gray-500">Silakan pilih Tanggal Mulai dan Tanggal Akhir untuk melihat Laporan.</p>
        </div>
    @endif
</div>
@endsection
