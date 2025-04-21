<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriprodukController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// =============================
// Halaman utama
// ============================= 
Route::get('/', function () {
    return view('welcome');
});

// =============================
// Auth Routes (Login/Register/Logout)
// ============================= 
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Redirect ke dashboard setelah login
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

// =============================
// Route dengan middleware "auth"
// ============================= 
Route::middleware('auth')->group(function () {
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('kategoriproduk', KategoriprodukController::class);
    Route::resource('pembayaran', PembayaranController::class);

    Route::get('/penjualan/struk/{id}', [PenjualanController::class, 'cetakStruk'])->name('penjualan.struk');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Laporan Penjualan
    Route::get('/penjualan/laporan/cetak', [PenjualanController::class, 'printLaporan'])->name('penjualan.laporan.cetak');
    Route::get('/penjualan/laporan/pdf', [PenjualanController::class, 'cetakLaporanPDF'])->name('penjualan.laporan.pdf');
});

// =============================
// Middleware untuk Admin
// ============================= 
// Route::middleware(['admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

//     // ✅ Verifikasi user kasir
//     Route::get('/admin/verifikasi', [AdminController::class, 'listPending'])->name('admin.verifikasi.index');
//     // Route untuk memverifikasi kasir
//     Route::get('/admin/verifikasi/{id}', [AdminController::class, 'verifikasiProses'])->name('admin.verifikasi.proses');

// });

// =============================
// Middleware untuk Kasir
// ============================= 
// Route::middleware(['kasir'])->group(function () {
//     Route::get('/dashboard/kasir', [KasirController::class, 'index'])->name('dashboard.kasir');
// });
