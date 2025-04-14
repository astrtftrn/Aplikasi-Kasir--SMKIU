@extends('layout.template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Edit Kategori</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategoriproduk.update', $kategori->KategoriID) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="NamaKategori" class="form-label">Nama Kategori:</label>
                            <input type="text" id="NamaKategori" name="NamaKategori" 
                                class="form-control @error('NamaKategori') is-invalid @enderror" 
                                value="{{ old('NamaKategori', $kategori->NamaKategori) }}" required>
                            @error('NamaKategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Deskripsi" class="form-label">Deskripsi:</label>
                            <textarea id="Deskripsi" name="Deskripsi" class="form-control @error('Deskripsi') is-invalid @enderror" rows="3">{{ old('Deskripsi', $kategori->Deskripsi) }}</textarea>
                            @error('Deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-45">Update</button>
                            <button type="button" class="btn btn-secondary w-45" onclick="window.history.back();">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
