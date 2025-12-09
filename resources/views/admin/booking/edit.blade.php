@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Booking</h2>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pengguna</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Kamar</label>
            <select name="room_id" class="form-control" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                        {{ $room->name }} - {{ $room->room_number }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Cek In</label>
            <input type="date" name="check_in" class="form-control"
                value="{{ $booking->check_in }}" required>
        </div>

        <div class="mb-3">
            <label>Cek Out</label>
            <input type="date" name="check_out" class="form-control"
                value="{{ $booking->check_out }}" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Tamu</label>
            <input type="number" name="guest_count" class="form-control"
                value="{{ $booking->guest_count }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="booked" {{ $booking->status=='booked' ? 'selected':'' }}>Booked</option>
                <option value="checked_in" {{ $booking->status=='checked_in' ? 'selected':'' }}>Check In</option>
                <option value="checked_out" {{ $booking->status=='checked_out' ? 'selected':'' }}>Check Out</option>
                <option value="cancelled" {{ $booking->status=='cancelled' ? 'selected':'' }}>Cancelled</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
