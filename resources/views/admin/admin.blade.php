@extends('layout')

@section('page_title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Ringkasan Operasional</h2>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-red-500">
            <p class="text-sm font-medium text-gray-500">Total Kamar</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalRooms }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-yellow-500">
            <p class="text-sm font-medium text-gray-500">Total Booking</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalBookings }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-500">Pendapatan Bersih (Paid)</p>
            <p class="text-3xl font-extrabold text-green-600 mt-1">Rp. {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
            <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalUsers }}</p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold text-red-700 mb-4 border-b pb-2">⚠️ Peringatan Stok Rendah</h3>
            <ul class="space-y-3">
                @forelse ($lowStockRooms as $room)
                    <li class="flex justify-between items-center text-sm p-2 bg-red-50 rounded-lg">
                        <span class="font-medium text-gray-900">{{ $room->nama_kamar }}</span>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-200 text-red-900">
                            Stok: {{ $room->stok }}
                        </span>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">Semua stok kamar aman.</li>
                @endforelse
            </ul>
        </div>
        
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">5 Booking Terbaru</h3>
            <ul class="space-y-4">
                @forelse ($latestBookings as $booking)
                    <li class="p-3 border rounded-lg hover:bg-gray-50 transition duration-150">
                        <div class="flex justify-between items-start">
                            <div class="flex flex-col">
                                <span class="text-base font-semibold text-red-600">
                                    Booking #{{ $booking->id }}
                                </span>
                                <span class="text-sm text-gray-700">
                                    {{ $booking->room->nama_kamar ?? 'Kamar Dihapus' }} ({{ $booking->user->name ?? 'User Dihapus' }})
                                </span>
                            </div>
                            <div class="text-right">
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-green-100 text-green-800',
                                    ][$booking->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $statusClass }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <p class="text-xs text-gray-500 mt-1">
                                    Check-in: {{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">Belum ada booking terbaru.</li>
                @endforelse
            </ul>
            <div class="mt-4 text-right">
                <a href="{{ route('booking.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Lihat Semua Booking &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection
