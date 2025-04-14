<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans'; 
    protected $primaryKey = 'PembayaranID'; 

    protected $fillable = [
        'PenjualanID',
        'TanggalPembayaran',
        'TotalHarga', // Tambahan field TotalHarga
        'JumlahPembayaran',
        'Kembalian', // Tambahan field Kembalian
        'MetodePembayaran',
        'StatusPembayaran',
    ];

    protected $casts = [
        'TotalHarga' => 'decimal:2', // Cast tipe data TotalHarga ke desimal 2 angka di belakang koma
        'JumlahPembayaran' => 'decimal:2', 
        'Kembalian' => 'decimal:2', // Cast tipe data Kembalian ke desimal 2 angka di belakang koma
    ];

    // Relasi ke model Penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'PenjualanID', 'PenjualanID');
    }
}
