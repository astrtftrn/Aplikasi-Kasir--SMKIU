@extends('layout.template')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ isset($pembayaran) ? 'Edit' : 'Tambah' }} Pembayaran</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ isset($pembayaran) ? route('pembayaran.update', $pembayaran->PembayaranID) : route('pembayaran.store') }}" method="POST">
                @csrf
                @if(isset($pembayaran))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="PenjualanID" class="form-label">ID Penjualan</label>
                    <select name="PenjualanID" id="PenjualanID" class="form-select" required onchange="updateTotalHarga()">
                        <option value="" selected disabled>Pilih ID Penjualan</option>
                        @foreach($penjualans as $penjualan)
                            <option value="{{ $penjualan->PenjualanID }}" 
                                data-total-harga="{{ $penjualan->TotalHarga }}"
                                {{ isset($pembayaran) && $pembayaran->PenjualanID == $penjualan->PenjualanID ? 'selected' : '' }}>
                                {{ $penjualan->PenjualanID }} - {{ $penjualan->NamaPelanggan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="TotalHarga" class="form-label">Total Harga</label>
                    <input type="text" id="TotalHarga" class="form-control" value="" readonly>
                    <input type="hidden" name="TotalHarga" id="TotalHargaHidden">
                </div>

                <div class="mb-3">
                    <label for="TanggalPembayaran" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" name="TanggalPembayaran" id="TanggalPembayaran" class="form-control" value="{{ isset($pembayaran) ? $pembayaran->TanggalPembayaran : '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="JumlahPembayaran" class="form-label">Jumlah Pembayaran</label>
                    <input type="text" id="JumlahPembayaran" class="form-control" value="{{ isset($pembayaran) ? 'Rp ' . number_format($pembayaran->JumlahPembayaran, 0, ',', '.') : '' }}" required onkeyup="formatRupiah(this)">
                    <input type="hidden" name="JumlahPembayaran" id="JumlahPembayaranHidden" value="{{ isset($pembayaran) ? $pembayaran->JumlahPembayaran : '' }}">
                </div>

                <!-- Kembalian -->
                <div class="mb-3">
                    <label for="Kembalian" class="form-label">Kembalian</label>
                    <input type="text" id="Kembalian" class="form-control" readonly>
                    <input type="hidden" name="Kembalian" id="KembalianHidden">
                </div>

                <div class="mb-3">
                    <label for="MetodePembayaran" class="form-label">Metode Pembayaran</label>
                    <select name="MetodePembayaran" id="MetodePembayaran" class="form-select" required>
                        <option value="Transfer Bank" {{ isset($pembayaran) && $pembayaran->MetodePembayaran == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="Tunai" {{ isset($pembayaran) && $pembayaran->MetodePembayaran == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="Kartu Kredit" {{ isset($pembayaran) && $pembayaran->MetodePembayaran == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="StatusPembayaran" class="form-label">Status</label>
                    <select name="StatusPembayaran" id="StatusPembayaran" class="form-select" required>
                        <option value="Lunas" {{ isset($pembayaran) && $pembayaran->StatusPembayaran == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Belum Lunas" {{ isset($pembayaran) && $pembayaran->StatusPembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($pembayaran) ? 'Update' : 'Simpan' }}</button>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
function formatRupiah(input) {
    let angka = input.value.replace(/\D/g, ""); // Hapus semua karakter non-numeric
    let formatted = new Intl.NumberFormat('id-ID').format(angka);
    input.value = 'Rp ' + formatted;
    document.getElementById('JumlahPembayaranHidden').value = angka; // Simpan angka murni
    updateKembalian(); // Hitung kembalian
}

// Perbarui Total Harga saat memilih ID Penjualan
function updateTotalHarga() {
    let penjualanSelect = document.getElementById("PenjualanID");
    let selectedOption = penjualanSelect.options[penjualanSelect.selectedIndex];

    if (selectedOption) {
        let totalHarga = selectedOption.getAttribute("data-total-harga") || 0;
        document.getElementById("TotalHarga").value = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalHarga);
        document.getElementById("TotalHargaHidden").value = totalHarga;
        updateKembalian(); // Perbarui kembalian saat total harga berubah
    }
}

// Hitung Kembalian
function updateKembalian() {
    let totalHarga = parseInt(document.getElementById("TotalHargaHidden").value || 0);
    let jumlahBayar = parseInt(document.getElementById("JumlahPembayaranHidden").value || 0);
    let kembalian = jumlahBayar - totalHarga;

    if (kembalian < 0) {
        document.getElementById("Kembalian").value = "Rp 0";
        document.getElementById("KembalianHidden").value = 0;
    } else {
        document.getElementById("Kembalian").value = 'Rp ' + new Intl.NumberFormat('id-ID').format(kembalian);
        document.getElementById("KembalianHidden").value = kembalian;
    }
}

// Panggil updateTotalHarga saat halaman dimuat jika ada data pembayaran yang sudah diisi
document.addEventListener("DOMContentLoaded", function() {
    updateTotalHarga();
    updateKembalian();
});
</script>

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
        window.location.href = "{{ route('pembayaran.index') }}";
    </script>
@endif

@endsection
