<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama_kategori' => 'Pisang Premium',
                'deskripsi' => 'Pisang kualitas premium'
            ],
            [
                'nama_kategori' => 'Pisang Lokal',
                'deskripsi' => 'Pisang hasil petani lokal'
            ],
            [
                'nama_kategori' => 'Pisang Organik',
                'deskripsi' => 'Pisang tanpa pestisida'
            ],
            [
                'nama_kategori' => 'Pisang Ekspor',
                'deskripsi' => 'Pisang untuk ekspor'
            ],
            [
                'nama_kategori' => 'Pisang Olahan',
                'deskripsi' => 'Pisang untuk industri'
            ]
        ];

        foreach ($kategori as $item) {
            Kategori::create($item);
        }
    }
}