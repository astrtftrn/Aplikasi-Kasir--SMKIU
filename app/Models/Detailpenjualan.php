<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpenjualan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi Laravel
    protected $table = 'detailpenjualans';

    // Tentukan primary key yang digunakan
    protected $primaryKey = 'DetailID';

    // Tentukan kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'PenjualanID',
        'ProdukID',
        'JumlahProduk', 
        'Harga',
        'Subtotal', // Jika perlu, masukkan subtotal untuk disimpan
    ];

    // Tentukan tipe data untuk kolom yang perlu dikast
    protected $casts = [
        'JumlahProduk' => 'integer',
        'Subtotal' => 'decimal:2', // Pastikan Subtotal adalah desimal dengan 2 angka setelah titik
    ];

    // Relasi dengan model Penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'PenjualanID', 'PenjualanID');
    }

    // Relasi dengan model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID', 'ProdukID');
    }

    // Method untuk menghitung Subtotal
    public function calculateSubtotal()
    {
        // Mengambil harga produk dari relasi Produk
        $hargaProduk = $this->produk->Harga;  // Asumsi ada kolom Harga di tabel Produk
        return $this->JumlahProduk * $hargaProduk;
    }

    // Event untuk menghitung Subtotal secara otomatis sebelum data disimpan
    public static function boot()
    {
        parent::boot();

        static::saving(function ($detailpenjualan) {
            // Menghitung Subtotal sebelum menyimpan
            $detailpenjualan->Subtotal = $detailpenjualan->calculateSubtotal();
        });
    }
}
