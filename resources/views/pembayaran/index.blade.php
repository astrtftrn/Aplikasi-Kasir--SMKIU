@extends('layout.template')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pembayaran</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
        <form action="{{ route('pembayaran.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari ID Penjualan..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Kembalian</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    @if(auth()->user()->role == 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($pembayarans as $key => $pembayaran)
                <tr>
                    <td>{{ $pembayarans->firstItem() + $key }}</td>
                    <td>{{ date('d M Y', strtotime($pembayaran->TanggalPembayaran)) }}</td>
                    <td>Rp {{ number_format($pembayaran->TotalHarga, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($pembayaran->JumlahPembayaran, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($pembayaran->Kembalian, 2, ',', '.') }}</td>
                    <td>{{ $pembayaran->MetodePembayaran }}</td>
                    <td>
                        <span class="badge {{ $pembayaran->StatusPembayaran == 'Lunas' ? 'bg-success' : 'bg-danger' }}">
                            {{ $pembayaran->StatusPembayaran }}
                        </span>
                    </td>
                    @if(auth()->user()->role == 'admin')
                    <td>
                        <a href="{{ route('pembayaran.edit', $pembayaran->PembayaranID) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pembayaran.destroy', $pembayaran->PembayaranID) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $pembayarans->links() }}
    </div>
</div>
@endsection
