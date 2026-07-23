<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Demo Admin
        User::updateOrCreate(
            ['email' => 'chatgpt@gmail.com'],
            [
                'name' => 'ChatGPT Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Demo User Biasa
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User Biasa',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}