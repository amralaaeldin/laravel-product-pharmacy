<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'price' => $this->faker->randomFloat(2, 1, 1000000),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
