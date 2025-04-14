<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Pembayaran;


class AdminController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalProduk = Produk::count();
        $totalKategori = KategoriProduk::count();
        $totalPembayaran = Pembayaran::sum('JumlahPembayaran');

        return view('dashboard.admin', compact('totalPelanggan', 'totalPenjualan', 'totalProduk', 'totalKategori', 'totalPembayaran'));
    }

}
