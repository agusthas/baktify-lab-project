<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()
            ->count(10)
            ->create();

        foreach ($categories as $category) {
            $products = Product::factory()
                ->count(4)
                ->make();

            $category->products()->saveMany($products);
        }

        $this->call([
            UserSeeder::class,
        ]);
    }
}
