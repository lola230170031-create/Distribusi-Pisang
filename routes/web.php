<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LaporanController;

use App\Models\Supplier;


/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});



/*
|--------------------------------------------------------------------------
| Semua User yang Sudah Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Dashboard Admin & User
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');



    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {


        // Kategori Pisang
        Route::resource('kategori', KategoriController::class);



        // Data Pisang
        Route::resource('barang', BarangController::class);



        // Supplier
        Route::resource('supplier', SupplierController::class);



        // Pisang Masuk
        Route::resource('barang-masuk', BarangMasukController::class);



        // Distribusi Pisang
        Route::resource('barang-keluar', BarangKeluarController::class);



        // Export PDF Laporan Barang
        Route::get('/laporan/barang/pdf', 
            [LaporanController::class, 'barangPdf']
        )
        ->name('laporan.barang.pdf');

    });



    /*
    |--------------------------------------------------------------------------
    | API Supplier
    | Bisa diakses user login
    |--------------------------------------------------------------------------
    */

    Route::get('/api/supplier', function () {

        return response()->json(
            Supplier::all()
        );

    })
    ->name('web.api.supplier');

});