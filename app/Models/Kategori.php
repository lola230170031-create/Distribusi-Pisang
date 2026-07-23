<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // 1. Ditegaskan nama tabelnya di MySQL (mencegah error 'Table kategoris not found' jika beda nama)
    protected $table = 'kategoris'; 

    // 2. Ditegaskan Primary Key-nya (opsional tapi aman)
    protected $primaryKey = 'id';

    // 3. Kolom yang diizinkan diisi via form (Mass Assignment Protection)
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    /**
     * Relasi ke Model Barang (Satu Kategori punya Banyak Barang)
     */
    public function barang()
    {
        // Menyebutkan nama foreign key 'kategori_id' secara eksplisit agar aman dari error mismatch
        return $this->hasMany(Barang::class, 'kategori_id', 'id');
    }
}