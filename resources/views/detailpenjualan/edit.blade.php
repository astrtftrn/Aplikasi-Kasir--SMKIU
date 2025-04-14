{{-- @extends('layout.template')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit DetailPenjualan</title>
    <!-- Bootstrap CSS -->
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
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Edit DetailPenjualan</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('detailpenjualan.update', $detailpenjualan->DetailID) }}">
                    @csrf
                    @method('PUT')

                   <!-- PenjualanID -->
                   <div class="form-group mb-4">
                    <label for="PenjualanID" class="form-label">Penjualan ID</label>
                    <input type="text" class="form-control" id="PenjualanID" name="PenjualanID"
                        value="{{ old('PenjualanID', $detailpenjualan->PenjualanID) }}" placeholder="Masukkan Penjualan ID"
                        required>
                </div>

                <!-- ProdukID -->
                <div class="form-group mb-4">
                    <label for="ProdukID" class="form-label">Produk ID</label>
                    <input type="text" class="form-control" id="ProdukID" name="ProdukID"
                        value="{{ old('ProdukID', $detailpenjualan->ProdukID) }}" placeholder="Masukkan Produk ID"
                        required>
                </div>

                <!-- JumlahProduk -->
                <div class="form-group mb-4">
                    <label for="JumlahProduk" class="form-label">Jumlah Produk</label>
                    <input type="number" class="form-control" id="JumlahProduk" name="JumlahProduk"
                        value="{{ old('JumlahProduk', $detailpenjualan->JumlahProduk) }}" placeholder="Masukkan Jumlah Produk"
                        min="1" required>
                </div>

                <!-- Subtotal -->
                <div class="form-group mb-4">
                    <label for="Subtotal" class="form-label">Subtotal</label>
                    <input type="text" class="form-control" id="Subtotal" name="Subtotal"
                        value="{{ number_format($detailpenjualan->Subtotal, 3, '.', '.') }}" placeholder="Masukkan Subtotal"
                        required oninput="formatRupiah(this)">
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <button type="button" class="btn btn-secondary"
                        onclick="window.location.href='{{ route('detailpenjualan.index') }}'">
                        <i class="fas fa-times"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Bootstrap JS and FontAwesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        // Fungsi untuk memformat angka dengan titik setiap 3 digit
        function formatRupiah(input) {
            let angka = input.value.replace(/\./g, ''); // Hapus titik sebelumnya
            if (!isNaN(angka)) {
                input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik setiap 3 digit
            } else {
                input.value = input.value.replace(/[^\d]/g, ''); // Hapus karakter selain angka
            }
        }
    </script>
</body>

</html>
@endsection --}}