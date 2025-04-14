<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Pembayaran;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalProduk = Produk::count();
        $totalKategori = KategoriProduk::count();
        $totalPembayaran = Pembayaran::sum('JumlahPembayaran'); // Ubah ke lowercase jika sesuai dengan DB

        // Ambil produk dengan stok di bawah 10 misalnya
        $produk = Produk::where('stok', '<', 10)->get();

         // Ambil produk terlaris
    $produkTerlaris = DetailPenjualan::select('ProdukID', DB::raw('SUM(JumlahProduk) as total_terjual'))
    ->groupBy('ProdukID')
    ->orderByDesc('total_terjual')
    ->with('produk') // pastikan relasi dengan model Produk tersedia
    ->take(5)
    ->get();

        $data = compact('totalPelanggan', 'totalPenjualan', 'totalProduk', 'totalKategori', 'totalPembayaran', 'produk', 'produkTerlaris');

        // Debugging (Opsional, hapus jika sudah tidak perlu)
        // dd($data);

        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('dashboard.admin', $data);
            } elseif (Auth::user()->role == 'kasir') {
                return view('dashboard.kasir', $data);
            } else {
                return redirect()->route('login')->with('error', 'Anda tidak memiliki akses!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }
    }
}