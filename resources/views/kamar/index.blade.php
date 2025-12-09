@extends('layouts.guest_master')

@section('title', 'Available Rooms')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Our Elegant Rooms</h1>
    <p class="text-xl text-gray-600 mb-10">Choose the perfect sanctuary for your stay.</p>

    <div class="p-4 mb-10 bg-white rounded-xl shadow-lg border border-gray-100">
        <form action="{{ route('rooms.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-5 items-center">
            
            <div class="col-span-1 md:col-span-2">
                <label for="check_in" class="block mb-1 text-xs font-medium text-gray-700">Check-in / Check-out</label>
                <div class="flex space-x-2">
                    <input type="date" id="check_in" name="check_in" value="{{ request('check_in') }}" class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md">
                    <input type="date" id="check_out" name="check_out" value="{{ request('check_out') }}" class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md">
                </div>
            </div>

            <div class="col-span-1">
                <label for="guests" class="block mb-1 text-xs font-medium text-gray-700">Guests</label>
                <select id="guests" name="guests" class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md">
                    <option value="">Any</option>
                    <option value="1" {{ request('guests') == '1' ? 'selected' : '' }}>1 Adult</option>
                    <option value="2" {{ request('guests') == '2' ? 'selected' : '' }}>2 Adults</option>
                    <option value="3" {{ request('guests') == '3' ? 'selected' : '' }}>3+ Adults</option>
                </select>
            </div>

            <div class="col-span-1">
                <label for="type" class="block mb-1 text-xs font-medium text-gray-700">Room Type</label>
                <select id="type" name="type" class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md">
                    <option value="">Any Type</option>
                    <option value="Single" {{ request('type') == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Double" {{ request('type') == 'Double' ? 'selected' : '' }}>Double</option>
                    <option value="Suite" {{ request('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                </select>
            </div>

            <div class="col-span-1 flex items-end">
                <button type="submit" class="w-full px-4 py-2 text-sm font-semibold text-white transition duration-200 bg-red-600 rounded-md hover:bg-red-700">
                    Filter Rooms
                </button>
            </div>
        </form>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($rooms as $room)
        <div class="bg-white rounded-xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300 border border-gray-200">
            <div class="relative h-60 w-full">
                @if($room->gambar)
                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $room->gambar) }}" alt="{{ $room->nama_kamar }}">
                @else
                <div class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-500">No Image Available</div>
                @endif
                <span class="absolute top-3 right-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                    {{ $room->tipe_kamar }}
                </span>
            </div>

            <div class="p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $room->nama_kamar }}</h3>
                    <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ $room->deskripsi }}</p>
                    
                    <div class="flex items-center space-x-4 text-sm text-gray-700 mt-2">
                        <span><i class="fa-solid fa-person"></i> Max 2 Guests</span>
                        <span class="font-medium {{ $room->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                            @if($room->stok > 0)
                                {{ $room->stok }} Rooms Available
                            @else
                                Fully Booked
                            @endif
                        </span>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t flex justify-between items-center">
                    <span class="text-3xl font-extrabold text-red-600">
                        Rp. {{ number_format($room->harga, 0, ',', '.') }}
                    </span>
                    <a href="{{ route('rooms.book', $room->id) }}" 
                       class="px-5 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 transition duration-150 {{ $room->stok <= 0 ? 'opacity-50 pointer-events-none bg-gray-500 hover:bg-gray-500' : '' }}">
                        {{ $room->stok > 0 ? 'Book Now' : 'Sold Out' }}
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="md:col-span-3 text-center p-12 bg-white rounded-xl shadow-lg">
            <p class="text-xl text-gray-500">Sorry, no rooms match your search criteria.</p>
            <p class="text-sm text-gray-400 mt-2">Please adjust your check-in dates or filters.</p>
        </div>
        @endforelse
    </div>
    <div class="mt-10">
        {{ $rooms->links() }}
    </div>

</div>
@endsection

