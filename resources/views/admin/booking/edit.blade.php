@extends('layout')

@section('page_title', 'Update Status Booking #'. $booking->id)

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Update Status Booking #{{ $booking->id }}</h2>
        <p class="text-gray-500">Customer: <span class="font-semibold text-gray-700">{{ $booking->user->name ?? 'User Dihapus' }}</span> | Kamar: <span class="font-semibold text-gray-700">{{ $booking->room->nama_kamar ?? 'Kamar Dihapus' }}</span></p>
    </div>

    <div class="bg-white p-8 shadow-lg rounded-xl max-w-lg">
        
        <form action="{{ route('booking.update', $booking->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Saat Ini</label>
                @php
                    $statusClass = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'confirmed' => 'bg-green-100 text-green-800',
                        'checked_in' => 'bg-blue-100 text-blue-800',
                        'canceled' => 'bg-red-100 text-red-800',
                    ][$booking->status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusClass }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Ubah Status Menjadi</label>
                <select id="status" name="status" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                    <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="checked_in" {{ old('status', $booking->status) == 'checked_in' ? 'selected' : '' }}>Checked-in</option>
                    <option value="canceled" {{ old('status', $booking->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
                @error('status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('booking.index') }}" class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg shadow-md hover:bg-gray-300 transition duration-150">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 transition duration-150">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
