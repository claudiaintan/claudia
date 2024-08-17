<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TampilProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiPelangganController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('/produk', TampilProdukController::class)->only(['index', 'show'])->names('produk');
Route::get('/produk/kategori/{kategoriId}', [TampilProdukController::class, 'byKategori'])->name('produk.byKategori');

Route::middleware('guest')->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('/login', function () {
            return view('auth.login');
        })->name('login');

        Route::get('/admin_login', function () {
            return view('auth.login_admin');
        });

        Route::get('/register', function () {
            return view('auth.register');
        })->name('register');

        Route::post('/login', LoginController::class)->name('post-login');
        Route::post('/admin_login', AdminLoginController::class)->name('post-admin-login');
        Route::post('/register', RegisterController::class)->name('post-signup');
    });
});

Route::middleware('auth')->group(function () {
    Route::name('auth.')->group(function () {
        Route::post('/logout', LogoutController::class)->name('logout');
    });

    Route::name('profile.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('update');
    });

    Route::middleware('role:PELANGGAN')->prefix('/pelanggan')->name('pelanggan.')->group(function () {
        Route::resource('/keranjang', KeranjangController::class)->except(['show'])->names('keranjang');
        Route::resource('/transaksi', TransaksiPelangganController::class)->names('transaksi');
    });

    Route::middleware('role:ADMIN')->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('', DashboardController::class)->name('dashboard');

            Route::name('dashboard.profile.')->group(function () {
                Route::get('/profile', [DashboardProfileController::class, 'edit'])->name('edit');
                Route::put('/profile', [DashboardProfileController::class, 'update'])->name('update');
            });

            Route::prefix('/master')->name('master.')->group(function () {
                Route::resource('/pelanggan', PelangganController::class)->names('pelanggan');
                Route::resource('/kategori', KategoriController::class)->names('kategori');
                Route::get('/transaksi/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
                Route::resource('/transaksi', TransaksiController::class)->names('transaksi');
                Route::resource('/produk', ProdukController::class)->names('produk');
            });
        });
    });

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/download/{transaksi}', [TransaksiController::class, 'download'])->name('transaksi.download');
});
