@extends('layout.template')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Kategori Produk</h3>
        </div>
        <div class="card-body">
            
            <!-- Pencarian -->
            <form method="GET" action="{{ route('kategoriproduk.index') }}" class="mb-3 d-flex">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari berdasarkan nama">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            
            <!-- Tombol Tambah -->
            <div class="mb-3 text-end">
                <a href="{{ route('kategoriproduk.create') }}" class="btn btn-success">Tambah Kategori</a>
            </div>
            
            <!-- Tabel Kategori -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoris as $index => $kategori)
                            <tr>
                                <td>{{ $index + 1 + ($kategoris->currentPage() - 1) * $kategoris->perPage() }}</td>
                                <td>{{ $kategori->NamaKategori }}</td>
                                <td>{{ $kategori->Deskripsi }}</td>
                                <td>
                                    <a href="{{ route('kategoriproduk.edit', $kategori->KategoriID) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kategoriproduk.destroy', $kategori->KategoriID) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data kategori produk</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>
</div>
@endsection