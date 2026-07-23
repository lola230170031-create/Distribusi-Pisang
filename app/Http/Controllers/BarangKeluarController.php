<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Menampilkan semua data barang keluar
     */
    public function index()
    {
        $barangKeluar = BarangKeluar::with('barang')
                        ->latest()
                        ->get();

        return view('barang_keluar.index', compact('barangKeluar'));
    }

    /**
     * Form tambah barang keluar
     */
    public function create()
    {
        $barang = Barang::all();

        return view('barang_keluar.create', compact('barang'));
    }

    /**
     * Simpan barang keluar
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id'      => 'required|exists:barangs,id',
            'tanggal_keluar' => 'required|date',
            'jumlah'         => 'required|integer|min:1',
            'tujuan'         => 'required|string|max:255',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Cek kecukupan stok
        if ($request->jumlah > $barang->stok) {
            return back()->withInput()->with('error', 'Stok barang tidak mencukupi. Stok saat ini: ' . $barang->stok);
        }

        DB::transaction(function () use ($request, $barang) {
            BarangKeluar::create([
                'barang_id'      => $request->barang_id,
                'tanggal_keluar' => $request->tanggal_keluar,
                'jumlah'         => $request->jumlah,
                'tujuan'         => $request->tujuan,
            ]);

            // Kurangi stok barang
            $barang->decrement('stok', $request->jumlah);
        });

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil disimpan.');
    }

    /**
     * Detail barang keluar
     */
    public function show(BarangKeluar $barangKeluar)
    {
        return view('barang_keluar.show', compact('barangKeluar'));
    }

    /**
     * Form edit
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        $barang = Barang::all();

        return view('barang_keluar.edit', compact('barangKeluar', 'barang'));
    }

    /**
     * Update data
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $request->validate([
            'barang_id'      => 'required|exists:barangs,id',
            'tanggal_keluar' => 'required|date',
            'jumlah'         => 'required|integer|min:1',
            'tujuan'         => 'required|string|max:255',
        ]);

        $barangTarget = Barang::findOrFail($request->barang_id);

        // Hitung estimasi stok jika transaksi ini diperbarui
        if ($barangKeluar->barang_id == $request->barang_id) {
            // Jika barangnya SAMA: Stok Efektif = Stok Saat Ini + Jumlah Lama
            $stokTersedia = $barangTarget->stok + $barangKeluar->jumlah;
        } else {
            // Jika barang BEDA: Stok Efektif = Stok Barang Baru
            $stokTersedia = $barangTarget->stok;
        }

        // Cek kecukupan stok
        if ($request->jumlah > $stokTersedia) {
            return back()->withInput()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $stokTersedia);
        }

        DB::transaction(function () use ($request, $barangKeluar, $barangTarget) {
            // 1. Kembalikan stok barang lama
            $barangLama = Barang::find($barangKeluar->barang_id);
            if ($barangLama) {
                $barangLama->increment('stok', $barangKeluar->jumlah);
            }

            // 2. Update transaksi
            $barangKeluar->update([
                'barang_id'      => $request->barang_id,
                'tanggal_keluar' => $request->tanggal_keluar,
                'jumlah'         => $request->jumlah,
                'tujuan'         => $request->tujuan,
            ]);

            // 3. Kurangi stok barang baru (refresh agar nilai terbaru didapat)
            Barang::where('id', $request->barang_id)->decrement('stok', $request->jumlah);
        });

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Data distribusi berhasil diupdate.');
    }

    /**
     * Hapus data
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        DB::transaction(function () use ($barangKeluar) {
            // Kembalikan stok ke data barang
            $barang = Barang::find($barangKeluar->barang_id);
            if ($barang) {
                $barang->increment('stok', $barangKeluar->jumlah);
            }

            $barangKeluar->delete();
        });

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Data distribusi berhasil dihapus.');
    }
}