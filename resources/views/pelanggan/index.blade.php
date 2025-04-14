@extends('layout.template')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Pelanggan</title>
    <!-- Bootstrap CSS -->
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
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-sm {
            padding: 5px 10px;
        }
        .btn-primary, .btn-outline-secondary {
            font-weight: bold;
        }
        .search-form {
            max-width: 600px;
            margin: 0 auto;
        }
        .pagination {
            margin-top: 1.5rem;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Kasir Pelanggan</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button Create -->
        @if (Auth::user()->role == 'admin')
         <div class="text-end mb-3">
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>Tambah Pelanggan
            </a>
         </div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('pelanggan.index') }}" method="GET" class="search-form mb-4">
            <div class="input-group">
                <input 
                    type="text" 
                    id="search" 
                    name="search" 
                    class="form-control" 
                    placeholder="Cari pelanggan..." 
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        @if (Auth::user()->role == 'admin')
                        <th>Aksi</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggans as $pelanggan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pelanggan->NamaPelanggan }}</td>
                            <td>{{ $pelanggan->Alamat }}</td>
                            <td>{{ $pelanggan->NomorTelepon }}</td>
                            <td>{{ $pelanggan->Email }}</td>
                            @if (Auth::user()->role == 'admin')
                            <td>
                                <a href="{{ route('pelanggan.edit', $pelanggan->PelangganID) }}" 
                                   class="btn btn-info btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form 
                                    action="{{ route('pelanggan.destroy', $pelanggan->PelangganID) }}" 
                                    method="POST" 
                                    class="d-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $pelanggans->appends(request()->except('page'))->links() }}
        </div>
    </div>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
@endsection
