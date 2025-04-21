<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Pembayaran;
use App\Models\User; // Tambahkan ini

class AdminController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalProduk = Produk::count();
        $totalKategori = KategoriProduk::count();
        $totalPembayaran = Pembayaran::sum('JumlahPembayaran');

        return view('dashboard.admin', compact(
            'totalPelanggan',
            'totalPenjualan',
            'totalProduk',
            'totalKategori',
            'totalPembayaran'
        ));
    }

    // ✅ Menampilkan daftar user (kasir) yang belum diverifikasi
//     public function listPending()
// {
//     $users = \App\Models\User::select('UserID', 'name', 'email')
//         ->where('role_as', 'kasir')
//         ->where('status', 'pending')
//         ->get();

//     return view('admin.verifikasi', compact('users'));
// }

    // ✅ Verifikasi user (kasir)
//     public function verifikasi($id)
// {
//     // Cari kasir berdasarkan ID
//     $kasir = User::findOrFail($id);

//     // Verifikasi kasir
//     $kasir->is_verified = true;
//     $kasir->save();

//     // Redirect kembali ke halaman verifikasi
//     return redirect()->route('admin.verifikasi.index')->with('success', 'Kasir telah diverifikasi.');
// }
}
