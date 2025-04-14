@extends('layout.template')

@section('content')

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="text-center text-primary mb-4">Tambah Kategori</h3>
                
                <form action="{{ route('kategoriproduk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="NamaKategori" class="form-label">Nama Kategori:</label>
                        <input type="text" id="NamaKategori" name="NamaKategori" class="form-control" placeholder="Masukkan Nama Kategori" required>
                    </div>

                    <div class="mb-3">
                        <label for="Deskripsi" class="form-label">Deskripsi:</label>
                        <textarea id="Deskripsi" name="Deskripsi" class="form-control" placeholder="Masukkan Deskripsi" rows="3" required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary w-48">Simpan</button>
                        <button type="button" class="btn btn-secondary w-48" onclick="window.history.back();">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
