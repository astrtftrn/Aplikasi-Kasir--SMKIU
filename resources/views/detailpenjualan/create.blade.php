{{-- @extends('layout.template')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create DetailPenjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #007bff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1.1rem;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            font-size: 1.1rem;
            padding: 10px 20px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .alert {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .form-control {
            font-size: 1.1rem;
        }

        .form-group label {
            font-size: 1rem;
            font-weight: 600;
        }

        .error-message {
            font-size: 0.875rem;
            color: red;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Create DetailPenjualan</h1>

        <!-- Pesan Error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('detailpenjualan.store') }}">
            @csrf

            <!-- PenjualanID -->
            <div class="form-group">
                <label for="PenjualanID">Penjualan ID</label>
                <select name="PenjualanID" id="PenjualanID" class="form-control select2" required>
                    <option value="">--Pilih Penjualan--</option>
                    @foreach ($penjualans as $penjualan)
                        <option value="{{ $penjualan->PenjualanID }}">
                            {{ $penjualan->PenjualanID }}
                        </option>
                    @endforeach
                </select>
                @error('PenjualanID')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            <!-- ProdukID -->
            <div class="form-group">
                <label for="ProdukID">Produk ID</label>
                <select name="ProdukID" id="ProdukID" class="form-control select2" required>
                    <option value="">--Pilih Produk--</option>
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->ProdukID }}" data-harga="{{ $produk->Harga }}">
                            {{ $produk->ProdukID }} - {{ $produk->NamaProduk }}
                        </option>
                    @endforeach
                </select>
                @error('ProdukID')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            <!-- JumlahProduk -->
            <div class="form-group">
                <label for="JumlahProduk">Jumlah Produk</label>
                <input type="number" class="form-control" id="JumlahProduk" name="JumlahProduk"
                    value="{{ old('JumlahProduk') }}" placeholder="Masukkan jumlah produk" min="1" required>
                @error('JumlahProduk')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            <!-- Subtotal -->
            <div class="form-group">
                <label for="Subtotal">Subtotal</label>
                <input type="text" class="form-control" id="Subtotal" name="Subtotal" value="{{ old('Subtotal') }}"
                    placeholder="Subtotal akan otomatis terisi" oninput="formatRupiah(this)">
                @error('Subtotal')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary btn-block">Create</button>

            <!-- Tombol Kembali -->
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-block mt-3">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('ProdukID').addEventListener('change', calculateSubTotal);
        document.getElementById('JumlahProduk').addEventListener('input', calculateSubTotal);

        function calculateSubTotal() {
            const produkSelect = document.getElementById('ProdukID');
            const jumlahInput = document.getElementById('JumlahProduk');
            const subTotalInput = document.getElementById('Subtotal');

            // Ambil harga dari atribut data-harga di opsi terpilih
            const harga = produkSelect.options[produkSelect.selectedIndex]?.getAttribute('data-harga');
            const jumlah = jumlahInput.value;

            if (harga && jumlah && jumlah > 0) {
                // Menghitung subtotal
                const subTotal = parseFloat(harga) * parseInt(jumlah);
                subTotalInput.value = formatRupiah(subTotal.toString()); // Format hasil sebagai Rupiah
            } else {
                subTotalInput.value = ''; // Kosongkan jika data tidak valid
            }
        }

        // Fungsi untuk format angka menjadi format Rupiah
        // Fungsi untuk format angka menjadi format Rupiah
        function formatRupiah(value) {
            value = value.replace(/[^0-9.]/g, ''); // Hanya angka dan titik yang diizinkan
            let parts = value.split('.'); // Pisahkan angka dan desimal
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Format angka ribuan

            // Hapus tambahan ".000" jika tidak ada angka desimal
            if (parts[1]) {
                parts[1] = parts[1].substring(0, 2); // Ambil hanya 2 angka desimal
                return parts.join(','); // Ganti titik desimal dengan koma (format Rupiah)
            }

            return parts[0]; // Jika tidak ada angka desimal, kembalikan angka utuh tanpa tambahan
        }

        // Fungsi untuk membersihkan format sebelum dikirim ke server
        function cleanRupiah(value) {
            return value.replace(/\./g, ''); // Hapus titik pemisah ribuan
        }

        // Pastikan subtotal dikonversi sebelum pengiriman form
        document.querySelector('form').addEventListener('submit', function(e) {
            const subTotalInput = document.getElementById('Subtotal');
            subTotalInput.value = cleanRupiah(subTotalInput.value); // Membersihkan format Rupiah
        });
    </script>

</body>

</html>
@endsection --}}