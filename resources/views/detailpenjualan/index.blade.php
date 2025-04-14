{{-- @extends('layout.template')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir DetailPenjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #007bff;
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Kasir DetailPenjualan</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-end mb-3">
            <a href="{{ route('detailpenjualan.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>Tambah DetailPenjualan
            </a>
        </div>

        <form action="{{ route('detailpenjualan.index') }}" method="GET" class="search-form mb-4">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Cari detailpenjualan..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark bg-primary text-white">
                    <tr>
                        <th>#</th>
                        <th>Tanggal Penjualan</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detailpenjualans as $detailpenjualan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detailpenjualan->penjualan->TanggalPenjualan ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $detailpenjualan->produk->NamaProduk ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $detailpenjualan->JumlahProduk }}</td>
                            <td>Rp {{ number_format($detailpenjualan->Subtotal, 0, '.', '.') }}</td>
                            <td>
                                <a href="{{ route('detailpenjualan.edit', $detailpenjualan->DetailID) }}" class="btn btn-info btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('detailpenjualan.destroy', $detailpenjualan->DetailID) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $detailpenjualans->appends(request()->except('page'))->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
@endsection --}}