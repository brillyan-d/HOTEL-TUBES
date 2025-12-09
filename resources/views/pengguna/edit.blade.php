@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Pengguna</h2>

    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                value="{{ $pengguna->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                value="{{ $pengguna->email }}" required>
        </div>

        <div class="mb-3">
            <label>Password (kosongkan jika tidak diganti)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="admin" {{ $pengguna->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="tamu" {{ $pengguna->role == 'tamu' ? 'selected' : '' }}>Tamu</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>
@endsection
