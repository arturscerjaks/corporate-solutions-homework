<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some default products in stock
        Product::factory()
            ->count(20)
            ->create();

        // And some who are OOS
        Product::factory()
            ->count(5)
            ->outOfStock()
            ->create();
    }
}
