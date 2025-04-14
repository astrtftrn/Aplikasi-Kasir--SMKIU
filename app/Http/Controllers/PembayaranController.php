<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Penjualan;

class PembayaranController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pembayarans = Pembayaran::when($search, function ($query, $search) {
            return $query->where('PenjualanID', 'like', "%{$search}%");
        })->orderBy('TanggalPembayaran', 'desc')->paginate(10);

        return view('pembayaran.index', compact('pembayarans'));
    }

    // Menampilkan form tambah pembayaran
    public function create()
    {
        $penjualans = Penjualan::all();
        return view('pembayaran.create', compact('penjualans'));
    }

    // Menyimpan data pembayaran ke database
    public function store(Request $request)
{
    $request->validate([
        'PenjualanID' => 'required|exists:penjualans,PenjualanID',
        'TanggalPembayaran' => 'required|date',
        'JumlahPembayaran' => 'required|string',
        'MetodePembayaran' => 'required|string|max:50',
        'StatusPembayaran' => 'required|in:Lunas,Belum Lunas',
    ]);

    // Ambil total harga dari tabel penjualans berdasarkan ID
    $penjualan = Penjualan::findOrFail($request->PenjualanID);
    $totalHarga = $penjualan->TotalHarga;

    // Format input Jumlah Pembayaran
    $jumlahPembayaran = (float) str_replace(['Rp', '.', ','], ['', '', ''], $request->JumlahPembayaran);

    // Hitung kembalian
    $kembalian = $jumlahPembayaran - $totalHarga;
    if ($kembalian < 0) {
        $kembalian = 0; // Jika pembayaran kurang dari total harga, kembalian tetap 0
    }

    // Simpan data pembayaran
    Pembayaran::create([
        'PenjualanID' => $request->PenjualanID,
        'TanggalPembayaran' => $request->TanggalPembayaran,
        'JumlahPembayaran' => $jumlahPembayaran,
        'MetodePembayaran' => $request->MetodePembayaran,
        'StatusPembayaran' => $request->StatusPembayaran,
        'TotalHarga' => $totalHarga,  // Simpan total harga dari transaksi
        'Kembalian' => $kembalian,  // Simpan kembalian yang sudah dihitung
    ]);

    return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan!');
}

    // Menampilkan detail pembayaran
    public function show($id)
    {
        $pembayaran = Pembayaran::with('penjualan')->findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    // Menampilkan form edit pembayaran
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $penjualans = Penjualan::all();
        return view('pembayaran.edit', compact('pembayaran', 'penjualans'));
    }

    // Mengupdate data pembayaran di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'PenjualanID' => 'required|exists:penjualans,PenjualanID',
            'TanggalPembayaran' => 'required|date',
            'TotalHarga' => 'required|string', // Tambahan validasi untuk TotalHarga
            'JumlahPembayaran' => 'required|string',
            'Kembalian' => 'nullable|string', // Tambahan validasi untuk Kembalian
            'MetodePembayaran' => 'required|string|max:50',
            'StatusPembayaran' => 'required|in:Lunas,Belum Lunas',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $totalHarga = (float) str_replace([',', '.', 'Rp'], '', $request->TotalHarga);
        $jumlahPembayaran = (float) str_replace([',', '.', 'Rp'], '', $request->JumlahPembayaran);
        $kembalian = $request->Kembalian ? (float) str_replace([',', '.', 'Rp'], '', $request->Kembalian) : 0.00;

        $pembayaran->update([
            'PenjualanID' => $request->PenjualanID,
            'TanggalPembayaran' => $request->TanggalPembayaran,
            'TotalHarga' => $totalHarga, // Update TotalHarga
            'JumlahPembayaran' => $jumlahPembayaran,
            'Kembalian' => $kembalian, // Update nilai kembalian
            'MetodePembayaran' => $request->MetodePembayaran,
            'StatusPembayaran' => $request->StatusPembayaran,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    // Menghapus data pembayaran
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
