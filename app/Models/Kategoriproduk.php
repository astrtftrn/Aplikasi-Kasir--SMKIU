<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoriproduk extends Model
{
    use HasFactory;
    protected $table = 'kategoriproduks';  // Nama tabel Penjualan
    protected $primaryKey = 'KategoriID';  // Primary key pada tabel
    protected $fillable = [
        'NamaKategori',
        'Deskripsi',
    ];

    public function produk ()
{
    return $this->hasMany(Produk::class);
}
}
