<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian dari request
        $search = $request->input('search');

        // Query untuk model Pelanggan
        $query = Pelanggan::query();

        // Jika ada pencarian, tambahkan kondisi WHERE
        if ($search) {
            $query->where('NamaPelanggan', 'LIKE', '%' . $search . '%');
        }

        // Paginate hasil query
        $pelanggans = $query->paginate(10);

        // Return view dengan data pelanggans
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
{
    $pelanggans = Pelanggan::all(); // Ambil semua data pelanggan
    return view('pelanggan.create', compact('pelanggans'));
}


    public function store(Request $request)
    {
        // Validasi data request
        $this->validate($request, [
            'NamaPelanggan' => 'required|max:255',
            'Alamat' => 'required',
            'NomorTelepon' => 'required|max:15',
            'Email' => 'required|max:255',
        ]);

        // Membuat data pelanggan baru
        Pelanggan::create([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomorTelepon' => $request->NomorTelepon,
            'Email' => $request->Email,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dibuat.');
    }

    public function edit($id)
    {
        // Mencari data pelanggan berdasarkan ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Return view dengan data pelanggan
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data request
        $this->validate($request, [
            'NamaPelanggan' => 'required|max:255',
            'Alamat' => 'required',
            'NomorTelepon' => 'required|max:15',
            'Email' => 'required|max:255',
        ]);

        // Mencari data pelanggan berdasarkan ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Update data pelanggan
        $pelanggan->update([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomorTelepon' => $request->NomorTelepon,
            'Email' => $request->Email,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Mencari data pelanggan berdasarkan ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Menghapus data pelanggan
        $pelanggan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
