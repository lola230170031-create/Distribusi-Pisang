<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierApiController extends Controller
{
    /**
     * Menampilkan semua supplier
     */
    public function index()
    {
        return response()->json(Supplier::all());
    }

    /**
     * Menyimpan supplier baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $supplier = Supplier::create($request->all());

        return response()->json([
            'message' => 'Supplier berhasil ditambahkan',
            'data' => $supplier
        ], 201);
    }

    /**
     * Menampilkan satu supplier
     */
    public function show(string $id)
    {
        return response()->json(
            Supplier::findOrFail($id)
        );
    }

    /**
     * Update supplier
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->update($request->all());

        return response()->json([
            'message' => 'Supplier berhasil diupdate',
            'data' => $supplier
        ]);
    }

    /**
     * Hapus supplier
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return response()->json([
            'message' => 'Supplier berhasil dihapus'
        ]);
    }
}