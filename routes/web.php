<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, KategoriController, AlatController, PesananController,
    PengembalianController, PelangganController, LaporanController,
    DashboardController, FrontController, KeranjangController
};

// ========================================================
// 1. PUBLIC ROUTES (Tanpa Login)
// ========================================================
Route::get('/', function () { return view('welcome'); });
Route::get('/katalog', [FrontController::class, 'katalog']);
Route::get('/cara-sewa', function () { return view('cara-sewa'); });
Route::get('/kontak', function () { return view('kontak'); });

// Otentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Webhook Midtrans (Harus di luar Auth agar Midtrans bisa akses)
Route::post('/midtrans/callback', [FrontController::class, 'callback']);


// ========================================================
// 2. USER AUTH ROUTES (Penyewa)
// ========================================================
Route::middleware('auth')->group(function () {
    // Checkout
    Route::get('/checkout-all', [FrontController::class, 'checkoutAll']);
    Route::post('/checkout-all', [FrontController::class, 'prosesCheckoutAll']);
    
    // Riwayat
    Route::get('/riwayat', [FrontController::class, 'riwayat']);
    Route::get('/riwayat/{id}', [FrontController::class, 'detailRiwayat']);
    
    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index']);
    Route::post('/keranjang/tambah', [KeranjangController::class, 'store']);
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy']);
});


// ========================================================
// 3. ADMIN PANEL ROUTES
// ========================================================
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Manajemen Kategori
    Route::controller(KategoriController::class)->group(function () {
        Route::get('/kategori', 'index');
        Route::post('/kategori', 'store');
        Route::put('/kategori/{id}', 'update');
        Route::delete('/kategori/{id}', 'destroy');
    });

    // Manajemen Alat
    Route::controller(AlatController::class)->group(function () {
        Route::get('/alat', 'index');
        Route::post('/alat', 'store');
        Route::delete('/alat/{id}', 'destroy');
    });

    // Manajemen Pesanan
    Route::controller(PesananController::class)->group(function () {
        Route::get('/pesanan', 'index');
        Route::put('/pesanan/{id}/validasi', 'validasi');
    });

    // Pengembalian & Denda
    Route::put('/pengembalian/{id}/proses', [PengembalianController::class, 'prosesKembali']);
    Route::get('/pengembalian', [PengembalianController::class, 'index']);

    // Data Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index']);

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/cetak', [LaporanController::class, 'cetakPdf']);
});