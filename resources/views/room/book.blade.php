@extends('layouts.guest_master')

@section('title', 'Book: ' . $room->nama_kamar)

@section('content')
<div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Complete Your Booking</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 bg-white rounded-xl shadow-xl overflow-hidden h-fit sticky top-24 border border-gray-200">
            <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $room->gambar) }}" alt="{{ $room->nama_kamar }}">
            <div class="p-5">
                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $room->nama_kamar }}</h3>
                <p class="text-sm text-gray-500">{{ $room->tipe_kamar }} - Max 2 Guests</p>
                
                <div class="mt-4 pt-4 border-t">
                    <p class="text-lg text-gray-700">Price per night:</p>
                    <p class="text-3xl font-extrabold text-red-600">
                        Rp. {{ number_format($room->harga, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white p-8 rounded-xl shadow-xl border border-gray-200">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Booking Details</h3>

            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">{{ session('error') }}</div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="check_in_date" class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                        <input type="date" id="check_in_date" name="check_in_date" value="{{ old('check_in_date', request('check_in')) }}" required
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                        @error('check_in_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="check_out_date" class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                        <input type="date" id="check_out_date" name="check_out_date" value="{{ old('check_out_date', request('check_out')) }}" required
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                        @error('check_out_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="guest_count" class="block text-sm font-medium text-gray-700 mb-1">Number of Guests</label>
                    <input type="number" id="guest_count" name="guest_count" value="{{ old('guest_count', 1) }}" min="1" required
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                    @error('guest_count') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('rooms.index') }}" class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg shadow-md hover:bg-gray-300 transition duration-150">
                        Back to Rooms
                    </a>
                    <button type="submit" class="px-8 py-3 text-base font-semibold text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 transition duration-150">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
