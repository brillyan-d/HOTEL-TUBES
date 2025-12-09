@extends('layout')

@section('content')
<h2>Edit Kamar</h2>

<form action="{{ route('kamar.update', $kamar->id) }}" method="POST">
    @csrf
    @method('PUT')

    Nomor Kamar:<br>
    <input type="text" name="nomor_kamar" value="{{ $kamar->nomor_kamar }}"><br><br>

    Tipe:<br>
    <input type="text" name="tipe" value="{{ $kamar->tipe }}"><br><br>

    Harga:<br>
    <input type="number" name="harga" value="{{ $kamar->harga }}"><br><br>

    Status:<br>
    <select name="status">
        <option value="tersedia" {{ $kamar->status=='tersedia'?'selected':'' }}>Tersedia</option>
        <option value="terisi" {{ $kamar->status=='terisi'?'selected':'' }}>Terisi</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>
@endsection
