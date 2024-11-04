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
            'title' => $this->faker->words(3, true) . ' ' .  $this->faker->numberBetween(1, 5000),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
