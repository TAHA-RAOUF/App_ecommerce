<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Wooden Chair',
            'price' => 65.00,
        ]);

        Product::create([
            'name' => 'Single Armchair',
            'price' => 80.00,
        ]);

        Product::create([
            'name' => 'Wooden Armchair',
            'price' => 40.00,
        ]);

        Product::create([
            'name' => 'Stylish Chair',
            'price' => 100.00,
        ]);

        Product::create([
            'name' => 'Modern Chair',
            'price' => 120.00,
        ]);

        Product::create([
            'name' => 'Maple Wood Dining Table',
            'price' => 140.00,
        ]);

        Product::create([
            'name' => 'Arm Chair',
            'price' => 90.00,
        ]);

        Product::create([
            'name' => 'Wooden Bed',
            'price' => 140.00,
        ]);
    }
}

