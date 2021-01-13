<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'id' => 1,
                'name' => 'Screw Drivers',
            ],
            [
                'id' => 2,
                'name' => 'Buttons',
            ],
        ]);
    }
}
