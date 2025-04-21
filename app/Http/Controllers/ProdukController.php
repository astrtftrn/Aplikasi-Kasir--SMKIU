<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategoriproduk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Produk::with('kategori');

        if ($search) {
            $query->where('NamaProduk', 'LIKE', '%' . $search . '%')
                  ->orWhere('Deskripsi', 'LIKE', '%' . $search . '%');
        }

        $produks = $query->paginate(10);
        return view('produk.index', compact('produks'));
    }

    public function create()
{
    $kategori = Kategoriproduk::all();
    $produks = Produk::all(); // Tambahkan ini untuk mengambil daftar produk
    return view('produk.create', compact('kategori', 'produks'));
}


    public function store(Request $request)
    {
        $request->merge(['Harga' => str_replace('.', '', $request->Harga)]);

        $request->validate([
            'NamaProduk' => 'required|max:255',
            'Harga' => 'required|numeric',
            'Stok' => 'required|numeric',
            'Deskripsi' => 'nullable|string',
            'KategoriID' => 'required|exists:kategoriproduks,KategoriID',
            // 'GambarProduk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar
        ]);

        $data = $request->all();

        if ($request->hasFile('GambarProduk')) {
            $file = $request->file('GambarProduk');
            $path = $file->store('produk_images', 'public'); // Simpan ke storage/app/public/produk_images
            $data['GambarProduk'] = $path;
        }

        Produk::create($data);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dibuat.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategoriproduk::all();
        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->merge(['Harga' => str_replace('.', '', $request->Harga)]);

        $request->validate([
            'NamaProduk' => 'required|max:255',
            'Harga' => 'required|numeric',
            'Stok' => 'required|numeric',
            'Deskripsi' => 'nullable|string',
            'KategoriID' => 'required|exists:kategoriproduks,KategoriID',
            // 'GambarProduk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('GambarProduk')) {
            // Hapus gambar lama jika ada
            if ($produk->GambarProduk) {
                Storage::disk('public')->delete($produk->GambarProduk);
            }

            // Simpan gambar baru
            $file = $request->file('GambarProduk');
            $path = $file->store('produk_images', 'public');
            $data['GambarProduk'] = $path;
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar jika ada
        if ($produk->GambarProduk) {
            Storage::disk('public')->delete($produk->GambarProduk);
        }

        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
