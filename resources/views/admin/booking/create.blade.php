@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Booking</h2>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Pengguna</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- pilih pengguna --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Kamar</label>
            <select name="room_id" class="form-control" required>
                <option value="">-- pilih kamar --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">
                        {{ $room->name }} - {{ $room->room_number }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Cek In</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Cek Out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Tamu</label>
            <input type="number" name="guest_count" class="form-control" min="1" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
