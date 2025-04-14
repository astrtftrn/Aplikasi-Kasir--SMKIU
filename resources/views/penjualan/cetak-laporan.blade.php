<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        .info {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0f7e9;
            transition: background-color 0.3s;
        }

        .no-print {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .no-print button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .no-print button:hover {
            background-color: #45a049;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Penjualan</h2>
    </div>

    <div class="form-group">
        <label for="tanggal_laporan"><strong>Tanggal Laporan:</strong></label>
        <input type="date" id="tanggal_laporan" name="tanggal_laporan" 
            value="{{ $tanggalCetak }}" class="form-control" onchange="ubahTanggalLaporan(this.value)">
    </div>
    
    <script>
        function ubahTanggalLaporan(tanggal) {
            window.location.href = '?tanggal_cetak=' + tanggal;
        }
    </script>
    

    <div class="no-print">
        <button onclick="window.print()">Cetak Laporan</button>
        <button onclick="window.close()">Tutup</button>
    </div>

    @if ($penjualans->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Produk</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualans as $penjualan)
                    @foreach ($penjualan->details as $detail)
                        <tr>
                            <td>{{ $penjualan->TanggalPenjualan }}</td>
                            <td>{{ $penjualan->pelanggan->NamaPelanggan }}</td>
                            <td>{{ $detail->produk->NamaProduk }}</td>
                            <td>{{ $detail->JumlahProduk }}</td>
                            <td>Rp {{ number_format($detail->Harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->Subtotal, 0, ',', '.') }}</td>
                            <td>{{ $penjualan->pembayaran ? $penjualan->pembayaran->MetodePembayaran : '-' }}</td>
                            <td>{{ $penjualan->pembayaran ? $penjualan->pembayaran->StatusPembayaran : '-' }}</td>
                            <td>Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8" style="text-align: right;">Total Keseluruhan:</th>
                    <th>Rp {{ number_format($penjualans->sum('TotalHarga'), 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    @else
        <p style="text-align: center; margin-top: 20px;">Tidak ada data penjualan pada tanggal tersebut.</p>
    @endif
</body>

</html>
