<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    // 1. Tegaskan nama tabel di MySQL (mencegah error 'Table barang_keluars not found')
    protected $table = 'barang_keluars';

    // 2. Primary Key
    protected $primaryKey = 'id';

    // 3. Kolom yang diizinkan diisi via form (Mass Assignment)
    protected $fillable = [
        'barang_id',
        'tanggal_keluar',
        'jumlah',
        'tujuan',
    ];

    // 4. Casting tanggal agar bisa langsung diformat dengan Carbon di View (misal: $item->tanggal_keluar->format('d/m/Y'))
    protected $casts = [
        'tanggal_keluar' => 'date',
    ];

    /**
     * Relasi ke Model Barang (Setiap transaksi barang keluar terhubung ke 1 Barang)
     */
    public function barang()
    {
        // Menentukan nama foreign key 'barang_id' secara eksplisit agar aman dari error mismatch
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}