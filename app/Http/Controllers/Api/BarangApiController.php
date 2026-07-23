<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangApiController extends Controller
{
    // GET: /api/barang
    public function index()
    {
        $barang = Barang::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data inventaris pisang berhasil diambil',
            'data' => $barang
        ], 200);
    }

    // POST: /api/barang
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'nullable|numeric|min:0',
        ]);

        $barang = Barang::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data jenis pisang berhasil ditambahkan',
            'data' => $barang
        ], 201);
    }
}