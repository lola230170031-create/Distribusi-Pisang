<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Kategori;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $premium = Kategori::where('nama_kategori', 'Pisang Premium')->first();
        $lokal   = Kategori::where('nama_kategori', 'Pisang Lokal')->first();
        $organik = Kategori::where('nama_kategori', 'Pisang Organik')->first();
        $ekspor  = Kategori::where('nama_kategori', 'Pisang Ekspor')->first();
        $olahan  = Kategori::where('nama_kategori', 'Pisang Olahan')->first();

        Barang::insert([
            [
                'kategori_id'=>$premium->id,
                'kode_barang'=>'PSG001',
                'nama_barang'=>'Pisang Cavendish',
                'stok'=>120,
                'harga'=>25000,
                'deskripsi'=>'Pisang kualitas premium',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$premium->id,
                'kode_barang'=>'PSG002',
                'nama_barang'=>'Pisang Ambon',
                'stok'=>80,
                'harga'=>22000,
                'deskripsi'=>'Pisang Ambon',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$lokal->id,
                'kode_barang'=>'PSG003',
                'nama_barang'=>'Pisang Raja',
                'stok'=>90,
                'harga'=>18000,
                'deskripsi'=>'Pisang Raja',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$lokal->id,
                'kode_barang'=>'PSG004',
                'nama_barang'=>'Pisang Kepok',
                'stok'=>150,
                'harga'=>15000,
                'deskripsi'=>'Pisang Kepok',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$organik->id,
                'kode_barang'=>'PSG005',
                'nama_barang'=>'Pisang Organik',
                'stok'=>50,
                'harga'=>30000,
                'deskripsi'=>'Tanpa pestisida',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$ekspor->id,
                'kode_barang'=>'PSG006',
                'nama_barang'=>'Pisang Barangan',
                'stok'=>200,
                'harga'=>28000,
                'deskripsi'=>'Untuk ekspor',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$olahan->id,
                'kode_barang'=>'PSG007',
                'nama_barang'=>'Pisang Tanduk',
                'stok'=>70,
                'harga'=>17000,
                'deskripsi'=>'Untuk keripik',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$lokal->id,
                'kode_barang'=>'PSG008',
                'nama_barang'=>'Pisang Uli',
                'stok'=>60,
                'harga'=>16000,
                'deskripsi'=>'Pisang Uli',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$premium->id,
                'kode_barang'=>'PSG009',
                'nama_barang'=>'Pisang Mas',
                'stok'=>45,
                'harga'=>27000,
                'deskripsi'=>'Pisang Mas',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kategori_id'=>$ekspor->id,
                'kode_barang'=>'PSG010',
                'nama_barang'=>'Pisang Nangka',
                'stok'=>100,
                'harga'=>20000,
                'deskripsi'=>'Siap ekspor',
                'gambar'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}