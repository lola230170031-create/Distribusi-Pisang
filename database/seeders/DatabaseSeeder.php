<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ===========================
        // Admin
        // ===========================
        User::updateOrCreate(
            ['email' => 'admin@pisang.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@pisang.com',
                'role' => 'admin',
                'password' => Hash::make('Admin12345'),
            ]
        );

        // ===========================
        // User Demo
        // ===========================
        User::updateOrCreate(
            ['email' => 'user@pisang.com'],
            [
                'name' => 'User Demo',
                'email' => 'user@pisang.com',
                'role' => 'user',
                'password' => Hash::make('User12345'),
            ]
        );

        // ===========================
        // Seeder Data Master
        // ===========================
        $this->call([
            KategoriSeeder::class,
            SupplierSeeder::class,
            BarangSeeder::class,
        ]);
    }
}