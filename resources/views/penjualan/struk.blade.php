<!DOCTYPE html>
<html>
<head>
    <title>Struk Penjualan</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background: #f4f4f4; 
            padding: 20px;
            text-align: center;
        }
        .struk { 
            width: 320px; 
            background: #fff; 
            border: 2px solid #000; 
            padding: 15px; 
            margin: auto; 
            border-radius: 8px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            text-align: left;
        }
        .center { text-align: center; }
        h3 {
            margin: 0;
            padding-bottom: 5px;
            font-size: 18px;
            border-bottom: 2px solid #000;
        }
        .info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .total {
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
        }
        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        button, .btn-back {
            flex: 1;
            background: #007bff;
            color: #fff;
            border: none;
            padding: 8px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        button:hover {
            background: #0056b3;
        }
        .btn-back {
            background: #dc3545;
        }
        .btn-back:hover {
            background: #a71d2a;
        }
        /* Styling khusus saat dicetak */
        @media print {
            .btn-container { display: none; }
            body { background: none; }
            .struk { 
                box-shadow: none;
                border: 1px solid #000;
            }
        }
    </style>
</head>
<body>
    <div class="struk">
        <h3 class="center">TOKO SMKIU</h3>
        <p class="center"><small>Jl. Utama Raya PLN, Depok</small></p>
        <hr>

        <div class="info">
            <p><strong>ID Transaksi:</strong> {{ $penjualan->PenjualanID }}</p>
            <p><strong>Tanggal:</strong> {{ $penjualan->TanggalPenjualan }}</p>
            <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->NamaPelanggan }}</p>
            <p class="total"><strong>Total Harga:</strong> Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</p>
        </div>

        <hr>

        @if ($penjualan->pembayaran)
            <div class="info">
                <p><strong>Metode Pembayaran:</strong> {{ $penjualan->pembayaran->MetodePembayaran }}</p>
                <p><strong>Jumlah Dibayar:</strong> Rp {{ number_format($penjualan->pembayaran->JumlahPembayaran, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ $penjualan->pembayaran->StatusPembayaran }}</p>

                {{-- Hitung kembalian --}}
                @php
                    $kembalian = $penjualan->pembayaran->JumlahPembayaran - $penjualan->TotalHarga;
                @endphp

                @if ($kembalian > 0)
                    <p style="color: green; font-weight: bold;">
                        <strong>Kembalian:</strong> Rp {{ number_format($kembalian, 0, ',', '.') }}
                    </p>
                @endif

            </div>
        @else
            <p class="center" style="color: red;"><strong>Belum Ada Pembayaran</strong></p>
        @endif

        <hr>

        <p class="center"><small>Terima kasih telah berbelanja!</small></p>
        
        <div class="btn-container">
            <button onclick="window.print()">Cetak Struk</button>
            <a href="{{ route('penjualan.index') }}" class="btn-back">Kembali</a>
        </div>
    </div>
</body>
</html>
