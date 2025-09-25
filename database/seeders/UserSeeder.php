<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Buat Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Buat Customer
        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer Pertama',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]
        );
    }
}
