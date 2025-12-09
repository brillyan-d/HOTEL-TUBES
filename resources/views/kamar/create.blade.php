@extends('layout')

@section('content')
<h2>Tambah Kamar</h2>

<form action="{{ route('kamar.store') }}" method="POST">
    @csrf

    Nomor Kamar:<br>
    <input type="text" name="nomor_kamar"><br><br>

    Tipe:<br>
    <input type="text" name="tipe"><br><br>

    Harga:<br>
    <input type="number" name="harga"><br><br>

    Status:<br>
    <select name="status">
        <option value="tersedia">Tersedia</option>
        <option value="terisi">Terisi</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
