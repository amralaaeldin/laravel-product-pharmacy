<?php

namespace App\Console\Commands;

use App\Models\Pharmacy;
use App\Models\Product;
use Illuminate\Console\Command;

class productsSearchCheapest extends Command
{
    protected $signature = 'products:search-cheapest {id : The product ID}';

    protected $description = 'This command takes product_id and returns the cheapest 5 pharmacies have this product in a JSON format';

    public function handle()
    {
        $productId = $this->argument('id');

        $product = Product::with('pharmacies')->find($productId);

        if (!$product) {
            $this->error('Product not found.');
            return;
        }

        $cheapestPharmacies = $product->pharmacies->sortBy('pivot.price')->take(5)->map(function ($pharmacy) {
            return [
                'id' => $pharmacy->id,
                'name' => $pharmacy->name,
                'price' => $pharmacy->pivot->price / 100,
            ];
        });

        $jsonOutput = $cheapestPharmacies->toJson(JSON_PRETTY_PRINT);

        $this->info($jsonOutput);
    }
}
