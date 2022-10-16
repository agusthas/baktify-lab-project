<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty Stock Products
        Product::factory()
            ->count(20)
            ->state([
                'category_id' => Category::inRandomOrder()->first()->id,
            ])
            ->create();
    }
}
