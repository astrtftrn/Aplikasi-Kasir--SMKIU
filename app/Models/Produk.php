<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    
    protected $table = 'produks';
    protected $primaryKey = 'ProdukID'; 
    
    protected $fillable = [
        'NamaProduk',
        'Harga',
        'Stok', 
        'Deskripsi',
        'KategoriID',
        'GambarProduk' // Menambahkan field gambar produk
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategoriproduk::class, 'KategoriID'); 
    }

    public function details()
    {
        return $this->hasMany(Detailpenjualan::class);
    }
}
