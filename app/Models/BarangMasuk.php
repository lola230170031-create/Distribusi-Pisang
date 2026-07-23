<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    // 1. Ditegaskan nama tabelnya di MySQL
    protected $table = 'barang_masuks';

    // 2. Primary Key
    protected $primaryKey = 'id';

    // 3. Kolom yang diizinkan diisi via form (Mass Assignment)
    protected $fillable = [
        'barang_id',
        'supplier_id',
        'tanggal_masuk',
        'jumlah',
    ];

    // 4. Casting tanggal agar bisa langsung menggunakan format Carbon (misal: $item->tanggal_masuk->format('d/m/Y'))
    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    /**
     * Relasi ke Model Barang (Setiap transaksi masuk terhubung ke 1 Barang)
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    /**
     * Relasi ke Model Supplier (Setiap transaksi masuk terhubung ke 1 Supplier)
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}