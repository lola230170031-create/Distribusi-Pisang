<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Export Data Barang ke PDF
     */
    public function barangPdf()
    {
        try {

            // Ambil semua data barang beserta kategorinya
            $barang = Barang::with('kategori')->orderBy('nama_barang')->get();

            // Pastikan ada data
            if ($barang->isEmpty()) {
                return redirect()->back()->with('error', 'Data barang masih kosong.');
            }

            // Generate PDF
            $pdf = Pdf::loadView('laporan.barang_pdf', [
                'barang' => $barang
            ]);

            // Ukuran kertas
            $pdf->setPaper('A4', 'landscape');

            // Download PDF
            return $pdf->download('Laporan_Data_Pisang.pdf');

        } catch (\Exception $e) {

            return redirect()->back()->with(
                'error',
                'Gagal membuat PDF. Error: ' . $e->getMessage()
            );

        }
    }
}