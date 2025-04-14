@extends('layout.template')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 8px;
        }

        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
        }

        .preview-image {
            max-width: 200px;
            margin-top: 10px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Edit Produk</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('produk.update', $produk->ProdukID) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                     {{-- <!-- Upload Gambar Produk -->
                     <div class="form-group mb-4">
                        <label for="GambarProduk" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" id="GambarProduk" name="GambarProduk" accept="image/*" onchange="previewImage(event)">
                        @if($produk->GambarProduk)
                            <div class="mt-3">
                                <p>Gambar Saat Ini:</p>
                                <img src="{{ asset('storage/' . $produk->GambarProduk) }}" alt="Gambar Produk" class="preview-image">
                            </div>
                        @endif
                    </div> --}}

                    <!-- Nama Produk -->
                    <div class="form-group mb-4">
                        <label for="NamaProduk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="NamaProduk" name="NamaProduk"
                            value="{{ old('NamaProduk', $produk->NamaProduk) }}" placeholder="Masukkan nama produk"
                            required>
                    </div>

                    <!-- Harga -->
                    <div class="form-group mb-4">
                        <label for="Harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="Harga" name="Harga"
                            value="{{ number_format($produk->Harga, 0, ',', '.') }}" placeholder="Masukkan harga produk"
                            required oninput="formatRupiah(this)">
                    </div>

                    <!-- Stok -->
                    <div class="form-group mb-4">
                        <label for="Stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="Stok" name="Stok"
                            value="{{ old('Stok', $produk->Stok) }}" placeholder="Masukkan jumlah stok produk"
                            min="0" required>
                    </div>

                    <!-- Kategori Produk -->
                    <div class="form-group mb-4">
                        <label for="KategoriID" class="form-label">Kategori Produk</label>
                        <select class="form-control" id="KategoriID" name="KategoriID" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->KategoriID }}" {{ $kat->KategoriID == $produk->KategoriID ? 'selected' : '' }}>
                                    {{ $kat->NamaKategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group mb-4">
                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="4" placeholder="Masukkan deskripsi produk"
                            required>{{ old('Deskripsi', $produk->Deskripsi) }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <button type="button" class="btn btn-secondary"
                            onclick="window.location.href='{{ route('produk.index') }}'">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function formatRupiah(input) {
            let angka = input.value.replace(/\./g, '');
            if (!isNaN(angka)) {
                input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            } else {
                input.value = input.value.replace(/[^\d]/g, '');
            }
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const imgElement = document.createElement("img");
                imgElement.src = reader.result;
                imgElement.classList.add("preview-image");

                const previewContainer = document.querySelector("#GambarProduk").parentElement;
                const existingPreview = previewContainer.querySelector(".preview-image");
                if (existingPreview) {
                    existingPreview.remove();
                }
                previewContainer.appendChild(imgElement);
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>
@endsection
