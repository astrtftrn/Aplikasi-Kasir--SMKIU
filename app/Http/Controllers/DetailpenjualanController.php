<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Produk;
// use App\Models\Penjualan;
// use App\Models\Detailpenjualan;

// class DetailpenjualanController extends Controller
// {
//     public function index(Request $request)
//     {
//         $search = $request->input('search');
//         $query = Detailpenjualan::query();
//         if ($search) {
//             $query->where('JumlahProduk', 'LIKE', '%' . $search . '%');
//         }
//         $detailpenjualans = $query->paginate(10);
//         return view('detailpenjualan.index', compact('detailpenjualans'));
//     }

//     public function create()
//     {
//         $penjualans = Penjualan::all();
//         $produks = Produk::all();
//         return view('detailpenjualan.create', compact('penjualans', 'produks'));
//     }

//     public function store(Request $request)
// {
//     // Menghapus titik (.) pada Subtotal dan mengubahnya menjadi format ribuan
//     $subtotal = str_replace('.', '', $request->input('Subtotal'));

//     // Validasi input
//     $this->validate($request, [
//         'PenjualanID' => 'required|exists:penjualans,PenjualanID',
//         'ProdukID' => 'required|exists:produks,ProdukID',
//         'JumlahProduk' => 'required|integer',
//         'Subtotal' => 'required|numeric',
//     ]);

//     // Menyimpan detail penjualan
//     $detailpenjualan = Detailpenjualan::create([
//         'PenjualanID' => $request->input('PenjualanID'),
//         'ProdukID' => $request->input('ProdukID'),
//         'JumlahProduk' => $request->input('JumlahProduk'),
//         'Subtotal' => $subtotal,
//     ]);

//     // Mengurangi stok produk
//     $produk = Produk::findOrFail($request->input('ProdukID'));

//     // Periksa apakah stok mencukupi
//     if ($produk->Stok < $request->input('JumlahProduk')) {
//         return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
//     }

//     $produk->Stok -= $request->input('JumlahProduk');
//     $produk->save();

//     // Mengarahkan kembali ke halaman index
//     return redirect()->route('detailpenjualan.index')->with('success', 'Detailpenjualan berhasil dibuat dan stok produk diperbarui.');
// }

    
//     public function update(Request $request, $id)
//     {
//         // Menghapus titik (.) pada Subtotal dan mengubahnya menjadi format ribuan
//         $subtotal = str_replace('.', '', $request->input('Subtotal'));
    
//         // Validasi input
//         $this->validate($request, [
//             'PenjualanID' => 'required|exists:penjualans,PenjualanID',
//             'ProdukID' => 'required|exists:produks,ProdukID',
//             'JumlahProduk' => 'required|integer',
//             'Subtotal' => 'required|numeric',
//         ]);
    
//         $detailpenjualan = Detailpenjualan::findOrFail($id);
    
//         // Mengembalikan stok produk lama
//         $produk = Produk::findOrFail($detailpenjualan->ProdukID);
//         $produk->Stok += $detailpenjualan->JumlahProduk;
    
//         // Update detail penjualan
//         $detailpenjualan->update([
//             'PenjualanID' => $request->input('PenjualanID'),
//             'ProdukID' => $request->input('ProdukID'),
//             'JumlahProduk' => $request->input('JumlahProduk'),
//             'Subtotal' => $subtotal,
//         ]);
    
//         // Mengurangi stok produk setelah update
//         if ($produk->Stok < $request->input('JumlahProduk')) {
//             return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
//         }
    
//         $produk->Stok -= $request->input('JumlahProduk');
//         $produk->save();
    
//         return redirect()->route('detailpenjualan.index')->with('success', 'Detailpenjualan berhasil diperbarui dan stok produk disesuaikan.');
//     }
    
//     public function destroy($id)
//     {
//         $detailpenjualan = Detailpenjualan::findOrFail($id);
    
//         // Mengembalikan stok produk
//         $produk = Produk::findOrFail($detailpenjualan->ProdukID);
//         $produk->Stok += $detailpenjualan->JumlahProduk;
//         $produk->save();
    
//         $detailpenjualan->delete();
    
//         return redirect()->route('detailpenjualan.index')->with('success', 'Detailpenjualan berhasil dihapus dan stok produk dikembalikan.');
//     }
    

//     public function edit($id)
//     {
//         $detailpenjualan = Detailpenjualan::findOrFail($id);
//         // Menambahkan format rupiah pada subtotal untuk ditampilkan di form
//         $detailpenjualan->Subtotal = number_format($detailpenjualan->Subtotal, 0, ',', '.');
//         return view('detailpenjualan.edit', compact('detailpenjualan'));
//     }

  
// }
