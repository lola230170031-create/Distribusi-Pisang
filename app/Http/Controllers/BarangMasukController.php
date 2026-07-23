<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('barang', 'supplier')
                        ->latest()
                        ->get();

        return view('barang_masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $barang = Barang::all();
        $supplier = Supplier::all();

        return view('barang_masuk.create', compact('barang', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'     => 'required|exists:barangs,id',
            'supplier_id'   => 'required|exists:suppliers,id',
            'tanggal_masuk' => 'required|date',
            'jumlah'        => 'required|integer|min:1',
        ]);

        // Gunakan DB Transaction agar pembuatan data & perubahan stok berjalan serentak
        DB::transaction(function () use ($request) {
            BarangMasuk::create([
                'barang_id'     => $request->barang_id,
                'supplier_id'   => $request->supplier_id,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jumlah'        => $request->jumlah,
            ]);

            // Gunakan increment untuk atomicity
            Barang::where('id', $request->barang_id)->increment('stok', $request->jumlah);
        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data pisang masuk berhasil ditambahkan.');
    }

    public function show(BarangMasuk $barangMasuk)
    {
        return view('barang_masuk.show', compact('barangMasuk'));
    }

    public function edit(BarangMasuk $barangMasuk)
    {
        $barang = Barang::all();
        $supplier = Supplier::all();

        return view(
            'barang_masuk.edit',
            compact('barangMasuk', 'barang', 'supplier')
        );
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'barang_id'     => 'required|exists:barangs,id',
            'supplier_id'   => 'required|exists:suppliers,id',
            'tanggal_masuk' => 'required|date',
            'jumlah'        => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $barangMasuk) {
            // 1. Kembalikan stok barang lama (dikurangi sebesar jumlah sebelum diedit)
            $barangLama = Barang::find($barangMasuk->barang_id);
            if ($barangLama) {
                $barangLama->decrement('stok', $barangMasuk->jumlah);
            }

            // 2. Update data transaksi
            $barangMasuk->update([
                'barang_id'     => $request->barang_id,
                'supplier_id'   => $request->supplier_id,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jumlah'        => $request->jumlah,
            ]);

            // 3. Tambahkan stok barang baru
            Barang::where('id', $request->barang_id)->increment('stok', $request->jumlah);
        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data pisang masuk berhasil diperbarui.');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        DB::transaction(function () use ($barangMasuk) {
            // Kurangi stok ketika data dihapus (cek dulu apakah barang masih ada)
            $barang = Barang::find($barangMasuk->barang_id);
            if ($barang) {
                // Pastikan stok tidak minus saat dikurangi
                $stokKurang = min($barang->stok, $barangMasuk->jumlah);
                $barang->decrement('stok', $stokKurang);
            }

            $barangMasuk->delete();
        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data pisang masuk berhasil dihapus.');
    }
}