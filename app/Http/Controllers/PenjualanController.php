<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenjualanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $penjualans = Penjualan::with(['details.produk', 'pelanggan', 'pembayaran'])
        ->when($search, function ($query) use ($search) {
            $query->where('PenjualanID', 'like', "%$search%")
                ->orWhereHas('pelanggan', function ($q) use ($search) {
                    $q->where('NamaPelanggan', 'like', "%$search%");
                })
                ->orWhereHas('details.produk', function ($q) use ($search) {
                    $q->where('NamaProduk', 'like', "%$search%");
                });
        })
        ->orderByDesc('PenjualanID')
        ->paginate(10);

    return view('penjualan.index', compact('penjualans', 'search'));
}


    public function create()
    {
        return view('penjualan.create', [
            'pelanggans' => Pelanggan::all(),
            'produks' => Produk::all(),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'TanggalPenjualan' => 'required|date',
            'PelangganID' => 'required|integer',
            'ProdukID' => 'required|array',
            'ProdukID.*' => 'exists:produks,ProdukID',
            'JumlahProduk' => 'required|array',
            'JumlahProduk.*' => 'integer|min:1',
        ]);

        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Membuat data penjualan
            $penjualan = Penjualan::create([
                'TanggalPenjualan' => $request->TanggalPenjualan,
                'TotalHarga' => 0, // Akan diperbarui setelah detail dimasukkan
                'PelangganID' => $request->PelangganID,
            ]);

            $totalHarga = 0;

            // Memproses detail penjualan
            foreach ($request->ProdukID as $index => $produkID) {
                $produk = Produk::findOrFail($produkID);
                $jumlahProduk = $request->JumlahProduk[$index];

                // Periksa apakah stok cukup
                if ($produk->Stok < $jumlahProduk) {
                    return redirect()->back()->with('error', 'Stok produk ' . $produk->NamaProduk . ' tidak mencukupi.');
                }

                $subtotal = $produk->Harga * $jumlahProduk;
                $totalHarga += $subtotal;

                // Simpan detail penjualan
                Detailpenjualan::create([
                    'PenjualanID' => $penjualan->PenjualanID,
                    'ProdukID' => $produkID,
                    'JumlahProduk' => $jumlahProduk,
                    'Harga' => $produk->Harga,
                    'Subtotal' => $subtotal,
                ]);

                // Kurangi stok produk
                $produk->decrement('Stok', $jumlahProduk);
            }

            // Perbarui total harga di penjualan
            $penjualan->update(['TotalHarga' => $totalHarga]);

            // Commit transaksi jika semua berhasil
            DB::commit();

            return redirect()->route('pembayaran.create')->with('success', 'Penjualan berhasil dibuat.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('details.produk', 'pelanggan')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }


    public function destroy($PenjualanID)
    {
        $penjualan = Penjualan::findOrFail($PenjualanID);

        DB::beginTransaction();
        try {
            DetailPenjualan::where('PenjualanID', $PenjualanID)->delete();
            $penjualan->delete();

            DB::commit();
            return redirect()->route('penjualan.index')->with('success', 'Penjualan Berhasil Dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat menghapus penjualan: ' . $e->getMessage());
            return back()->withErrors(['details' => 'Gagal menghapus penjualan: ' . $e->getMessage()]);
        }
    }

    public function cetakStruk($id)
    {
        $penjualan = Penjualan::with(['details.produk', 'pelanggan', 'pembayaran'])
            ->where('PenjualanID', $id)
            ->firstOrFail();

        return view('penjualan.struk', compact('penjualan'));
    }

    public function printLaporan(Request $request)
{
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalSelesai = $request->input('tanggal_selesai');
    $tanggalCetak = $request->input('tanggal_cetak') ?? date('Y-m-d');

    $penjualans = Penjualan::with(['details.produk', 'pelanggan', 'pembayaran'])
        ->when($tanggalCetak, function ($query) use ($tanggalCetak) {
            $query->whereDate('TanggalPenjualan', $tanggalCetak);
        })
        ->when($tanggalMulai && $tanggalSelesai, function ($query) use ($tanggalMulai, $tanggalSelesai) {
            $query->whereBetween('TanggalPenjualan', [$tanggalMulai, $tanggalSelesai]);
        })
        ->orderBy('TanggalPenjualan', 'asc')
        ->get();

    return view('penjualan.cetak-laporan', compact('penjualans', 'tanggalMulai', 'tanggalSelesai', 'tanggalCetak'));
}


    // public function cetakPenjualan(Request $request)
    // {
    //     $search = $request->input('search');

    //     $penjualans = Penjualan::with(['details.produk', 'pelanggan', 'pembayaran'])
    //         ->when($search, function ($query) use ($search) {
    //             $query->where('PenjualanID', 'like', "%$search%")
    //                 ->orWhereHas('pelanggan', function ($q) use ($search) {
    //                     $q->where('nama', 'like', "%$search%");
    //                 });
    //         })
    //         ->orderByDesc('PenjualanID')
    //         ->get();

    //     return view('penjualan.cetak-penjualan', compact('penjualans', 'search'));
    // }


}
