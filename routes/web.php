<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AuthController; // Tambahkan import AuthController

// Halaman utama
Route::get('/', function () {
    return view('welcome'); // Ganti dengan halaman home yang sesuai
})->name('home');


// Route untuk register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Route untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route untuk logout (hanya bisa diakses oleh user yang login)
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


// Route dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('produk', App\Http\Controllers\ProdukController::class);
    Route::resource('kategoriproduk', App\Http\Controllers\KategoriprodukController::class);
    Route::resource('pembayaran', PembayaranController::class);

    Route::get('/penjualan/struk/{id}', [PenjualanController::class, 'cetakStruk'])
        ->name('penjualan.struk');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');

// Add this to your routes file
Route::get('/penjualan/laporan/cetak', [PenjualanController::class, 'printLaporan'])
    ->name('penjualan.laporan.cetak')
    ->middleware('auth');

    //Route untuk mencetak laporan penjualan sebagai PDF
    Route::get('/penjualan/laporan/pdf', [PenjualanController::class, 'cetakLaporanPDF'])
        ->name('penjualan.laporan.pdf')
        ->middleware('auth');
});

// Redirect ke home setelah login
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');


// Middleware untuk admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Middleware untuk kasir
Route::middleware(['kasir'])->group(function () {
    Route::get('/dashboard/kasir', [KasirController::class, 'index'])->name('dashboard.kasir');
});
