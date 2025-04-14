@extends('layout.template')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Pembayaran</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="PenjualanID" class="form-label">ID Penjualan</label>
                    <select name="PenjualanID" id="PenjualanID" class="form-select" required onchange="updateTotalHarga()">
                        <option value="" selected disabled>Pilih ID Penjualan</option>
                        @foreach($penjualans as $penjualan)
                            <option value="{{ $penjualan->PenjualanID }}" data-total="{{ $penjualan->TotalHarga }}">
                                {{ $penjualan->PenjualanID }} - {{ $penjualan->NamaPelanggan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Total Harga -->
                <div class="form-group">
                    <label for="TotalHarga">Total Harga</label>
                    <input type="text" name="TotalHarga" id="TotalHarga" class="form-control" required>
                </div>                
                

                <div class="mb-3">
                    <label for="TanggalPembayaran" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" name="TanggalPembayaran" id="TanggalPembayaran" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="JumlahPembayaran" class="form-label">Jumlah Pembayaran</label>
                    <input type="text" name="JumlahPembayaran" id="JumlahPembayaran" class="form-control" required oninput="hitungKembalian()">
                </div>

                <!-- Kembalian -->
                <div class="mb-3">
                    <label for="Kembalian" class="form-label">Kembalian</label>
                    <input type="text" id="Kembalian" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="MetodePembayaran" class="form-label">Metode Pembayaran</label>
                    <select name="MetodePembayaran" id="MetodePembayaran" class="form-select" required>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Tunai">Tunai</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="StatusPembayaran" class="form-label">Status</label>
                    <select name="StatusPembayaran" id="StatusPembayaran" class="form-select" required>
                        <option value="Lunas">Lunas</option>
                        <option value="Belum Lunas">Belum Lunas</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
    function updateTotalHarga() {
        let select = document.getElementById("PenjualanID");
        let totalHarga = select.options[select.selectedIndex].getAttribute("data-total");

        if (totalHarga) {
            document.getElementById("TotalHarga").value = formatRupiah(totalHarga);
        } else {
            document.getElementById("TotalHarga").value = "";
        }

        hitungKembalian();
    }

    function hitungKembalian() {
        let totalHarga = parseFloat(document.getElementById("TotalHarga").value.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
        let jumlahPembayaran = parseFloat(document.getElementById("JumlahPembayaran").value.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
        
        let kembalian = jumlahPembayaran - totalHarga;
        document.getElementById("Kembalian").value = kembalian > 0 ? formatRupiah(kembalian) : "Rp 0";
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
    }
</script>

@endsection
