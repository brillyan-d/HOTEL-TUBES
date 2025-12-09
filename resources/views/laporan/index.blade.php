<h2>Daftar Laporan</h2>

<a href="{{ route('laporans.create') }}">+ Buat Laporan Baru</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Tanggal</th>
        <th>Total Booking</th>
        <th>Transaksi Sukses</th>
        <th>Total Pendapatan</th>
        <th>Aksi</th>
    </tr>

    @foreach ($laporans as $l)
    <tr>
        <td>{{ $l->report_date }}</td>
        <td>{{ $l->total_bookings }}</td>
        <td>{{ $l->total_success_transactions }}</td>
        <td>{{ $l->total_income }}</td>
        <td>
            <a href="{{ route('laporans.edit', $l->id) }}">Edit</a>

            <form action="{{ route('laporans.destroy', $l->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
