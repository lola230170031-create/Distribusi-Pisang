<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // 1. Ditegaskan nama tabelnya di MySQL
    protected $table = 'barangs';

    // 2. Primary Key
    protected $primaryKey = 'id';

    // 3. Kolom yang diizinkan diisi via form (Mass Assignment)
    protected $fillable = [
        'kategori_id',
        'kode_barang',
        'nama_barang',
        'stok',
        'harga',
        'deskripsi',
        'gambar',
    ];

    /**
     * Relasi ke Kategori (Barang milik Satu Kategori)
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    /**
     * Relasi ke Barang Masuk (Satu Barang bisa punya Banyak Transaksi Masuk)
     */
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'barang_id', 'id');
    }

    /**
     * Relasi ke Barang Keluar / Distribusi (Satu Barang bisa punya Banyak Transaksi Keluar)
     */
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'barang_id', 'id');
    }
}