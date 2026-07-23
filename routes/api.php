<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\SupplierApiController;

Route::apiResource('barang', BarangApiController::class)
    ->names('api.barang');

Route::apiResource('supplier', SupplierApiController::class)
    ->names('api.supplier');