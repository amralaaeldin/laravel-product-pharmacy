<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PharmacyProductSeeder extends Seeder
{
    public function run()
    {
        $pharmacies = Pharmacy::all();

        foreach ($pharmacies as $pharmacy) {
            $productIds = Product::inRandomOrder()->take(rand(1, 50))->pluck('id');
            $pharmacy->products()->attach($productIds, [
                'quantity' => fake()->numberBetween(1, 100),
                'price' => fake()->randomNumber(9, 1),
            ]);
        }
    }
}
