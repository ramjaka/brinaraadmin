<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('sales-chart', [DashboardController::class, 'sales'])->name('sales');


    Route::prefix('users')->as('user.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('{user}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');

        Route::post('/', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
        Route::put('{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::delete('{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('categories')->as('category.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');
        Route::get('{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit');

        Route::post('/', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('create');
        Route::put('{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update');
        Route::delete('{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')->as('product.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('index');
        Route::get('/export', [\App\Http\Controllers\Admin\ProductController::class, 'export'])->name('export');
        Route::get('{product}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('edit');

        Route::post('/', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('create');
        Route::put('{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('update');
        Route::delete('{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('destroy');
        Route::delete('delete/multiple', [\App\Http\Controllers\Admin\ProductController::class, 'multipleDestroy'])->name('multipleDestroy');
    });

    Route::prefix('members')->as('member.')->group(function () {
        Route::get('download', [\App\Http\Controllers\Admin\MemberController::class, 'download'])->name('download');
        Route::get('/', [\App\Http\Controllers\Admin\MemberController::class, 'index'])->name('index');
        Route::get('{member}', [\App\Http\Controllers\Admin\MemberController::class, 'edit'])->name('edit');

        Route::post('/', [\App\Http\Controllers\Admin\MemberController::class, 'create'])->name('create');
        Route::put('{member}', [\App\Http\Controllers\Admin\MemberController::class, 'update'])->name('update');
        Route::delete('{member}', [\App\Http\Controllers\Admin\MemberController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('suppliers')->as('supplier.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SupplierController::class, 'index'])->name('index');
        Route::get('{supplier}', [\App\Http\Controllers\Admin\SupplierController::class, 'edit'])->name('edit');

        Route::post('/', [\App\Http\Controllers\Admin\SupplierController::class, 'create'])->name('create');
        Route::put('{supplier}', [\App\Http\Controllers\Admin\SupplierController::class, 'update'])->name('update');
        Route::delete('{supplier}', [\App\Http\Controllers\Admin\SupplierController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('pengeluaran')->as('pengeluaran.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PengeluaranController::class, 'index'])->name('index');
        Route::get('{pengeluaran}', [\App\Http\Controllers\Admin\PengeluaranController::class, 'edit'])->name('edit');

        Route::post('/', [\App\Http\Controllers\Admin\PengeluaranController::class, 'create'])->name('create');
        Route::put('{pengeluaran}', [\App\Http\Controllers\Admin\PengeluaranController::class, 'update'])->name('update');
        Route::delete('{pengeluaran}', [\App\Http\Controllers\Admin\PengeluaranController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('barang')->group(function () {
        Route::prefix('pembelian')->as('pembelian.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PembelianController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\PembelianController::class, 'create'])->name('create');
            Route::get('{supplier}/supplier', [\App\Http\Controllers\Admin\PembelianController::class, 'selectSupplier'])->name('selectSupplier');

            Route::post('/', [\App\Http\Controllers\Admin\PembelianController::class, 'store'])->name('store');
            Route::put('{pembelian}', [\App\Http\Controllers\Admin\PembelianController::class, 'update'])->name('update');
            Route::delete('{pembelian}', [\App\Http\Controllers\Admin\PembelianController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('penjualan')->as('penjualan.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PenjualanController::class, 'index'])->name('index');
            Route::get('{penjualan}', [\App\Http\Controllers\Admin\PenjualanController::class, 'show'])->name('show');

            Route::delete('{penjualan}', [\App\Http\Controllers\Admin\PenjualanController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('transaksi')->as('transaksi.')->group(function () {
        Route::prefix('pembelian')->as('pembelian.')->group(function () {
            Route::get('/baru', [\App\Http\Controllers\Admin\TransaksiPembelianController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\Admin\TransaksiPembelianController::class, 'create'])->name('create');
        });

        Route::prefix('penjualan')->as('penjualan.')->group(function () {
            Route::get('/baru', [\App\Http\Controllers\Admin\TransaksiPenjualanController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\Admin\TransaksiPenjualanController::class, 'create'])->name('create');
        });
    });

    Route::prefix('laporan')->as('laporan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('index');
        Route::get('/export', [\App\Http\Controllers\Admin\LaporanController::class, 'export'])->name('export');
    });

    Route::prefix('settings')->as('setting.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('update');
    });

    Route::prefix('cleaners')->as('cleaner.')->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\CleanerController::class, 'index'])->name('index');
        Route::get('/clear/{cleaner}', [\App\Http\Controllers\Admin\CleanerController::class, 'clear'])->name('clear');
    });
});
