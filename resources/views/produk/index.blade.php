@extends('layout.template')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-primary fw-bold">Kasir Produk</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (Auth::user()->role == 'admin')
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('produk.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>
        @endif

        <form action="{{ route('produk.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Cari produk..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped shadow-sm">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th>No</th>
                        {{-- <th>Gambar</th> --}}
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td>
                                <img src="{{ $produk->GambarProduk ? asset('storage/' . $produk->GambarProduk) : asset('images/no-image.png') }}"
                                    alt="Gambar Produk" class="img-thumbnail"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                            </td> --}}
                            <td>{{ $produk->NamaProduk }}</td>
                            <td>{{ $produk->kategori->NamaKategori ?? '-' }}</td>
                            <td>Rp {{ number_format($produk->Harga, 0, ',', '.') }}</td>
                            <td>{{ $produk->Stok }}</td>
                            <td>{{ $produk->Deskripsi }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('produk.edit', $produk->ProdukID) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('produk.destroy', $produk->ProdukID) }}" method="POST"
                                            onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role == 'admin' ? 8 : 7 }}" class="text-center text-muted">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $produks->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection
