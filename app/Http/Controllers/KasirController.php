<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Pembayaran;

class KasirController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalKategori = KategoriProduk::count();
        $totalProduk = Produk::count();
        $totalPembayaran = Pembayaran::sum('JumlahPembayaran');

        return view('dashboard.kasir', compact('totalPelanggan', 'totalPenjualan', 'totalKategori', 'totalProduk', 'totalPembayaran'));
    }
}
