<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    public function run(): void
    {
        Pharmacy::factory()->count(20000)->create();
    }
}
