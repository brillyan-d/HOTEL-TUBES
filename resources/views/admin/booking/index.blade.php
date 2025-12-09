@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Booking</h2>

    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">+ Tambah Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Pengguna</th>
                <th>Kamar</th>
                <th>Cek In</th>
                <th>Cek Out</th>
                <th>Jumlah Tamu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->room->name }}</td>
                <td>{{ $booking->check_in }}</td>
                <td>{{ $booking->check_out }}</td>
                <td>{{ $booking->guest_count }}</td>
                <td>
                    <span class="badge bg-info">{{ $booking->status }}</span>
                </td>
                <td>
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('bookings.destroy', $booking->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
