<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalJenis = Barang::count();
        $totalSupplier = Supplier::count();
        $totalStok = Barang::sum('stok');
        $stokHabis = Barang::where('stok', '<=', 0)->count();

        // Total nilai persediaan
        $totalNilaiPersediaan = Barang::sum(\DB::raw('stok * harga'));

        // Informasi Gudang
        $totalMasukKg = BarangMasuk::sum('jumlah');
        $totalKeluarKg = BarangKeluar::sum('jumlah');

        $stokMenipisCount = Barang::where('stok', '>', 0)
            ->where('stok', '<=', 5)
            ->count();

        // Data terbaru
        $masukTerbaru = BarangMasuk::with(['barang','supplier'])
            ->latest()
            ->take(5)
            ->get();

        $keluarTerbaru = BarangKeluar::with('barang')
            ->latest()
            ->take(5)
            ->get();

        $barangKritis = Barang::where('stok','<=',5)->get();
        
        // Statistik Status Stok
$stokAman = Barang::where('stok', '>', 20)->count();

$stokMenipis = Barang::where('stok', '>', 0)
    ->where('stok', '<=', 20)
    ->count();

$stokKosong = Barang::where('stok', '<=', 0)->count();

        return view('dashboard', compact(
            'totalJenis',
            'totalSupplier',
            'totalStok',
            'stokHabis',
            'totalNilaiPersediaan',
            'totalMasukKg',
            'totalKeluarKg',
            'stokMenipisCount',
            'masukTerbaru',
            'keluarTerbaru',
            'barangKritis',
            'stokAman',
'stokMenipis',
'stokKosong',
        ));
    }
}