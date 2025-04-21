@extends('layout.template')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Penjualan</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 2rem;
            }

            .card {
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                background-color: #0d6efd;
                color: white;
                font-size: 1.25rem;
                font-weight: bold;
            }

            .form-label {
                font-weight: bold;
            }

            .btn-success,
            .btn-primary,
            .btn-danger {
                width: 100%;
                font-size: 1rem;
                padding: 0.5rem;
            }

            .btn-danger {
                width: auto;
            }

            .table th,
            .table td {
                text-align: center;
                vertical-align: middle;
            }

            .subtotal,
            #TotalHarga {
                font-weight: bold;
                background-color: #e9ecef;
                text-align: right;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <h2 class="mb-4">Tambah Penjualan</h2>

            <!-- Notifikasi Error -->
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Form Penjualan -->
            <form action="{{ route('penjualan.store') }}" method="POST">
                @csrf

                <!-- Tanggal Penjualan -->
                <div class="mb-3">
                    <label for="TanggalPenjualan" class="form-label">Tanggal Penjualan</label>
                    <input type="date" class="form-control" id="TanggalPenjualan" name="TanggalPenjualan" required>
                </div>

                <!-- Pilihan Pelanggan -->
                <div class="mb-3">
                    <label for="PelangganID" class="form-label">Pelanggan</label>
                    <select class="form-control" name="PelangganID" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach ($pelanggans as $p)
                            <option value="{{ $p->PelangganID }}">{{ $p->NamaPelanggan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Produk & Jumlah -->
                <h4>Produk</h4>
                <table class="table" id="produkTable">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control produk-select" name="ProdukID[]" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach ($produks as $p)
                                        <option value="{{ $p->ProdukID }}" data-harga="{{ $p->Harga }}">
                                            {{ $p->NamaProduk }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" class="form-control harga-produk" readonly></td>
                            <td><input type="number" class="form-control jumlah-produk" name="JumlahProduk[]"
                                    min="1" value="1" required></td>
                            <td><input type="text" class="form-control subtotal-produk" readonly></td>
                            <td><button type="button" class="btn btn-danger remove-row">Hapus</button></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol Tambah Produk -->
                <button type="button" class="btn btn-success mb-3" id="addRow">Tambah Produk</button>

                <!-- Tombol Simpan dan Kembali -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
                </div>

            </form>
        </div>

        <!-- Script jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#TanggalPenjualan').on('change', function() {
        $(this).attr('readonly', true); // Setelah dipilih, input tidak bisa diketik manual
    });
});
</script>
        <script>
            $(document).ready(function() {
                function updateSubtotal(row) {
                    let harga = parseFloat(row.find(".harga-produk").val()) || 0;
                    let jumlah = parseInt(row.find(".jumlah-produk").val()) || 0;
                    let subtotal = harga * jumlah;
                    row.find(".subtotal-produk").val(subtotal.toLocaleString('id-ID'));
                }

                // Event saat produk dipilih
                $(document).on("change", ".produk-select", function() {
                    let row = $(this).closest("tr");
                    let harga = $(this).find(":selected").data("harga") || 0;
                    row.find(".harga-produk").val(harga);
                    updateSubtotal(row);
                });

                // Event saat jumlah produk diubah
                $(document).on("input", ".jumlah-produk", function() {
                    let row = $(this).closest("tr");
                    updateSubtotal(row);
                });

                // Tambah baris baru
                $("#addRow").click(function() {
                    let newRow = $("#produkTable tbody tr:first").clone();
                    newRow.find("select").val("");
                    newRow.find("input").val("");
                    $("#produkTable tbody").append(newRow);
                });

                // Hapus baris produk
                $(document).on("click", ".remove-row", function() {
                    if ($("#produkTable tbody tr").length > 1) {
                        $(this).closest("tr").remove();
                    } else {
                        alert("Minimal 1 produk harus dipilih.");
                    }
                });
            });
        </script>
    </body>
@endsection
