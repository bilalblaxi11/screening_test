<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'uuid' => "A101",
                'description' => 'Screwdriver',
                'category_id' => 1,
                'price' => '9.75'
            ],
            [
                'uuid' => "A102",
                'description' => 'Electric Screwdriver',
                'category_id' => 1,
                'price' => '49.75'
            ],
            [
                'uuid' => "B101",
                'description' => 'Basic on-off switch',
                'category_id' => 2,
                'price' => '4.99'
            ],
            [
                'uuid' => "B102",
                'description' => 'Press button',
                'category_id' => 2,
                'price' => '4.99'
            ],
            [
                'uuid' => "B103",
                'description' => 'Switch with motion detector',
                'category_id' => 2,
                'price' => '12.95'
            ],
        ]);
    }
}
