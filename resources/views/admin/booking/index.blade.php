@extends('layout')

@section('page_title', 'Daftar Semua Booking')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Booking</h2>
        {{-- Tombol Tambah Booking di Admin jarang, kita fokus ke manajemen existing booking --}}
    </div>

    @if ($message = Session::get('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ $message }}
    </div>
    @endif
    
    @if ($message = Session::get('error'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
        {{ $message }}
    </div>
    @endif

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID Booking
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kamar Dipesan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Check-in / Check-out
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Harga
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #{{ $booking->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $booking->user->name ?? 'User Dihapus' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->room->nama_kamar ?? 'Kamar Dihapus' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M') }} - {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-bold">
                            Rp. {{ number_format($booking->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @php
                                $statusClass = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'checked_in' => 'bg-blue-100 text-blue-800',
                                    'canceled' => 'bg-red-100 text-red-800',
                                ][$booking->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('booking.edit', $booking->id) }}" class="text-indigo-600 hover:text-indigo-900 p-2 rounded-lg hover:bg-indigo-50 transition duration-150">Manage Status</a>
                                <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus booking ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition duration-150">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                            Belum ada data booking.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection
