<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 2000; $i++) {
            DB::table('products')->insert([
                'name' => 'Product name ' . ($i + 1),
                'description' => 'Product description ' . ($i + 1),
                'price' => rand(100, 2000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
