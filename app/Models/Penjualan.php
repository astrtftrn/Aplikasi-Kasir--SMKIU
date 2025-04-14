<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';  
    protected $primaryKey = 'PenjualanID';  
    protected $fillable = [
        'TanggalPenjualan',
        'TotalHarga',
        'PelangganID',  
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID', 'PelangganID');
    }

    public function details()
    {
        return $this->hasMany(Detailpenjualan::class, 'PenjualanID', 'PenjualanID');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'PenjualanID', 'PenjualanID');
    }
}
