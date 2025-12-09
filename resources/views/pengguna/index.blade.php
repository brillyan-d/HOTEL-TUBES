@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pengguna</h2>

    <a href="{{ route('pengguna.create') }}" class="btn btn-primary mb-3">+ Tambah Pengguna</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge bg-info">{{ $user->role }}</span></td>

                <td>
                    <a href="{{ route('pengguna.edit', $user->id) }}"
                       class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('pengguna.destroy', $user->id) }}"
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Hapus pengguna ini?')">

                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
