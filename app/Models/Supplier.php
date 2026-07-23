<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // 1. Tegaskan nama tabel di MySQL (mencegah error 'Table suppliers / supplier not found')
    protected $table = 'suppliers';

    // 2. Tegaskan Primary Key
    protected $primaryKey = 'id';

    // 3. Kolom yang diizinkan diisi via form (Mass Assignment)
    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telepon',
        'email',
    ];

    /**
     * Relasi ke Barang Masuk (Satu Supplier bisa memasok Banyak Transaksi Barang Masuk)
     */
    public function barangMasuk()
    {
        // Menentukan nama foreign key 'supplier_id' secara eksplisit agar aman dari error mismatch
        return $this->hasMany(BarangMasuk::class, 'supplier_id', 'id');
    }
}