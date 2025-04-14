<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';

    // Primary key dari tabel
    protected $primaryKey = 'PelangganID';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = ['NamaPelanggan', 'Alamat', 'NomorTelepon', 'Email'];

    // Relasi ke model Penjualan
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }
}
