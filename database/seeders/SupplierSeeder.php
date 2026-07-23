<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [

            [
                'nama_supplier' => 'CV Tani Makmur',
                'alamat' => 'Aceh Utara',
                'telepon' => '081234567890',
                'email' => 'tanimakmur@gmail.com',
            ],

            [
                'nama_supplier' => 'UD Pisang Sejahtera',
                'alamat' => 'Lhokseumawe',
                'telepon' => '081234567891',
                'email' => 'pisangsejahtera@gmail.com',
            ],

            [
                'nama_supplier' => 'Kelompok Tani Barokah',
                'alamat' => 'Bireuen',
                'telepon' => '081234567892',
                'email' => 'barokah@gmail.com',
            ],

            [
                'nama_supplier' => 'CV Buah Nusantara',
                'alamat' => 'Langsa',
                'telepon' => '081234567893',
                'email' => 'buahnusantara@gmail.com',
            ],

            [
                'nama_supplier' => 'UD Tani Jaya',
                'alamat' => 'Pidie',
                'telepon' => '081234567894',
                'email' => 'tanijaya@gmail.com',
            ],

        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}