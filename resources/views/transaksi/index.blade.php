<h2>Data Transaksi</h2>

<a href="{{ route('transactions.create') }}">+ Tambah Transaksi</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Booking</th>
        <th>Jenis</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach ($transactions as $t)
    <tr>
        <td>{{ $t->id }}</td>
        <td>{{ $t->booking_id }}</td>
        <td>{{ $t->type }}</td>
        <td>{{ $t->amount }}</td>
        <td>{{ $t->status }}</td>
        <td>
            <a href="{{ route('transactions.edit', $t->id) }}">Edit</a>

            <form action="{{ route('transactions.destroy', $t->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
