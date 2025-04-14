@extends('layout.template')

@section('content')

<div class="container mt-4">
    <h3><b>Penjualan</b></h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('penjualan.create') }}" class="btn btn-primary btn-custom">
            <i class="bi bi-plus-circle-fill"></i> Tambah Data Penjualan
        </a>
    </div>

    <form action="{{ route('penjualan.index') }}" method="GET">
        <div class="input-group p-3">
            <input type="text" name="search" class="form-control" placeholder="Cari Penjualan" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Cari
            </button>
        </div>
    </form>

    <table class="table table-bordered text-center">
        <thead>
            <tr class="table-secondary">
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penjualans as $penjualan)
                @php
                    $details = $penjualan->details ?? collect();
                    $rowspan = $details->count() > 0 ? $details->count() : 1;
                @endphp
                <tr>
                    <td rowspan="{{ $rowspan }}">{{ $loop->iteration }}</td>
                    <td rowspan="{{ $rowspan }}">{{ $penjualan->TanggalPenjualan }}</td>
                    @if($details->isNotEmpty())
                        @foreach ($details as $index => $detail)
                            @if($index > 0) <tr> @endif
                                <td>{{ $detail->produk->NamaProduk ?? '-' }}</td>
                                <td>{{ $detail->JumlahProduk }}</td>
                                <td>Rp {{ number_format($detail->Harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($detail->Subtotal, 0, ',', '.') }}</td>
                                @if ($loop->first)
                                <td rowspan="{{ $rowspan }}">
                                    <a href="{{ route('penjualan.show', $penjualan->PenjualanID) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye-fill"></i> Show
                                    </a>

                                    <a href="{{ route('penjualan.struk', $penjualan->PenjualanID) }}" class="btn btn-sm btn-warning" target="_blank">
                                        <i class="bi bi-receipt"></i> Cetak Struk
                                    </a>

                                    @if(Auth::user()->role == 'admin')
                                        <form action="{{ route('penjualan.destroy', $penjualan->PenjualanID) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                @endif
                            @if($index > 0) </tr> @endif
                        @endforeach
                    @else
                        <td colspan="3">Tidak ada detail produk</td>
                        <td>
                            @if(Auth::user()->role == 'admin')
                                <form action="{{ route('penjualan.destroy', $penjualan->PenjualanID) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data Penjualan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $penjualans->links() }}
    </div>
</div>

@endsection
