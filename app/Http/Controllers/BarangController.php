<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar data pisang + Pencarian + Pagination
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $barang = Barang::with('kategori')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_barang', 'like', '%' . $keyword . '%')
                      ->orWhere('kode_barang', 'like', '%' . $keyword . '%')
                      // Bonus: Pencarian berdasarkan nama kategori
                      ->orWhereHas('kategori', function ($kategoriQuery) use ($keyword) {
                          $kategoriQuery->where('nama_kategori', 'like', '%' . $keyword . '%');
                      });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('barang.index', compact('barang', 'keyword'));
    }

    /**
     * Form tambah data pisang
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('barang.create', compact('kategori'));
    }

    /**
     * Simpan data pisang (Lengkap dengan Upload Gambar)
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required|string|max:30|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:255',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi foto (Maks 2MB)
        ]);

        $data = $request->only([
            'kategori_id', 'kode_barang', 'nama_barang', 'stok', 'harga', 'deskripsi'
        ]);

        // Upload Gambar jika diunggah oleh user
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar_barang', 'public');
        }

        Barang::create($data);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data pisang berhasil ditambahkan.');
    }

    /**
     * Detail data pisang
     */
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    /**
     * Form edit data pisang
     */
    public function edit(Barang $barang)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('barang.edit', compact('barang', 'kategori'));
    }

    /**
     * Update data pisang (Lengkap dengan Ganti Gambar & Hapus Gambar Lama)
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required|string|max:30|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:255',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only([
            'kategori_id', 'kode_barang', 'nama_barang', 'stok', 'harga', 'deskripsi'
        ]);

        // Pengelolaan Gambar Saat Update
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari penyimpanan jika ada
            if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
                Storage::disk('public')->delete($barang->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('gambar_barang', 'public');
        }

        $barang->update($data);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data pisang berhasil diperbarui.');
    }

    /**
     * Hapus data pisang (Otomatis hapus file foto dari folder)
     */
    public function destroy(Barang $barang)
    {
        // Hapus file gambar dari disk jika berkasnya ada
        if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data pisang berhasil dihapus.');
    }
}