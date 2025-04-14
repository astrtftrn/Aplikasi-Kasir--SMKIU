<?php

namespace App\Http\Controllers;

use App\Models\Kategoriproduk;
use Illuminate\Http\Request;

class KategoriprodukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Kategoriproduk::query();
        
        if ($search) {
            $query->where('NamaKategori', 'like', '%' . $search . '%'); // Pencarian berdasarkan NamaKategori
        }
        
        // Menambahkan pagination dan pengurutan
        $kategoris = $query->orderBy('created_at', 'desc')->paginate(10); 
        
        return view('kategoriproduk.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategoriproduk.create');
    }

    public function store(Request $request)
    {
        // Menambahkan validasi untuk kategori yang diinputkan
        $this->validate($request, [
            'NamaKategori' => 'required|max:255', 
            'Deskripsi' => 'nullable|string',
        ]);

        // Menyimpan kategori baru ke dalam database
        Kategoriproduk::create([
            'NamaKategori' => $request->NamaKategori,
            'Deskripsi' => $request->Deskripsi, 
        ]);
        
        return redirect()->route('kategoriproduk.index')->with('success', 'Berhasil Membuat Data Kategori');
    }

    public function edit($id)
    {
        // Validasi untuk memastikan kategori yang diminta ada
        $kategori = Kategoriproduk::findOrFail($id);
        return view('kategoriproduk.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input untuk pembaruan kategori
        $this->validate($request, [
            'NamaKategori' => 'required|max:255', 
            'Deskripsi' => 'nullable|string', // Deskripsi tidak wajib diisi
        ]);
        
        // Mengambil kategori yang akan diperbarui
        $kategori = Kategoriproduk::findOrFail($id);
        $kategori->update([
            'NamaKategori' => $request->NamaKategori,
            'Deskripsi' => $request->Deskripsi, // Jika kosong, akan disimpan sebagai null
        ]);
        
        return redirect()->route('kategoriproduk.index')->with('success', 'Berhasil Memperbarui Data Kategori');
    }

    public function destroy($id)
    {
        // Validasi untuk memastikan kategori yang akan dihapus ada
        $kategori = Kategoriproduk::findOrFail($id);
        $kategori->delete();
        
        return redirect()->route('kategoriproduk.index')->with('success', 'Berhasil Menghapus Data Kategori');
    }
}
