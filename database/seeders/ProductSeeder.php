<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Logo Minimalis',
                'description' => 'Desain logo minimalis modern untuk brand kamu.',
                'price' => 150000,
                'stock' => 10,
                'image' => null,
                'category_id' => 1, // Logo Design
                'promo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'UI/UX Landing Page',
                'description' => 'Desain UI/UX landing page profesional dan user-friendly.',
                'price' => 300000,
                'stock' => 5,
                'image' => null,
                'category_id' => 2, // UI/UX Design
                'promo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Poster Event',
                'description' => 'Desain poster menarik untuk event, konser, atau seminar.',
                'price' => 100000,
                'stock' => 20,
                'image' => null,
                'category_id' => 3, // Graphic Design
                'promo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Illustration Character',
                'description' => 'Ilustrasi karakter unik sesuai kebutuhan brand atau personal.',
                'price' => 250000,
                'stock' => 8,
                'image' => null,
                'category_id' => 4, // Illustration
                'promo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kemasan Produk',
                'description' => 'Desain kemasan produk yang elegan dan menarik pelanggan.',
                'price' => 200000,
                'stock' => 15,
                'image' => null,
                'category_id' => 5, // Packaging Design
                'promo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Template Instagram Feed',
                'description' => 'Template desain feed Instagram estetik untuk meningkatkan engagement.',
                'price' => 120000,
                'stock' => 25,
                'image' => null,
                'category_id' => 6, // Social Media Design
                'promo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
