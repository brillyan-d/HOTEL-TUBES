@extends('layout')

@section('content')
<h2>Daftar Kamar</h2>

<a href="{{ route('kamar.create') }}">+ Tambah Kamar</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nomor Kamar</th>
        <th>Tipe</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($kamars as $k)
    <tr>
        <td>{{ $k->id }}</td>
        <td>{{ $k->nomor_kamar }}</td>
        <td>{{ $k->tipe }}</td>
        <td>{{ $k->harga }}</td>
        <td>{{ $k->status }}</td>
        <td>
            <a href="{{ route('kamar.edit', $k->id) }}">Edit</a>

            <form action="{{ route('kamar.destroy', $k->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus kamar ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
