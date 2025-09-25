<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Logo Design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'UI/UX Design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Graphic Design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Illustration', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Packaging Design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Social Media Design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Web Design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Print Design', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
