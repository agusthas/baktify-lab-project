<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = collect($this->faker->unique()->words(mt_rand(2, 3)))
            ->map(function ($word) {
                return Str::ucfirst($word);
            })
            ->join(' ');
        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(10000, 100000),
            'stock' => $this->faker->numberBetween(0, 10),
            'picture' => 'random-image.png'
        ];
    }
}
