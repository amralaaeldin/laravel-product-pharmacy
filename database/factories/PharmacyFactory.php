<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyFactory extends Factory
{
    protected $model = Pharmacy::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company() . ' ' .  $this->faker->numberBetween(1, 999999),
            'address' => $this->faker->address(),
        ];
    }
}
