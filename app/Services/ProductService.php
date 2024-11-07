<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
  public function index()
  {
    try {
      $query = Product::query();

      if (request()->filled('search') && Str::length(request()->search) >= 2) {
        $searchTerm = request()->search;
        $query->where('title', 'LIKE', '%' . $searchTerm . '%');
      }

      $count = request()->query('count', 10);
      return $query->paginate($count);
    } catch (\Exception $e) {
      throw new \App\Exceptions\QueryDBException('An error occurred while retrieving.');
    }
  }

  public function store(StoreProductRequest $request)
  {
    try {
      $imagePath = 'https://www.mon-site-bug.fr/uploads/products/default-product.png';

      if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
      }

      $product = Product::create(
        array_merge(
          ['image' => $imagePath],
          $request->only([
            'title',
            'description',
          ])
        )
      );

      if ($request->has('pharmacies') && count($request->pharmacies) > 0) {
        foreach ($request->pharmacies as $pharmacyData) {
          $product->pharmacies()->attach($pharmacyData['id'], [
            'price' => $pharmacyData['price'] * 100,
            'quantity' => $pharmacyData['quantity'],
          ]);
        }
      }

      return $product;
    } catch (\Exception $e) {
      throw new \App\Exceptions\QueryDBException('An error occurred while creating.');
    }
  }

  public function show($id)
  {
    try {
      return Product::with('pharmacies:id,name,address')->findOrFail($id);
    } catch (\Exception $e) {
      throw new \App\Exceptions\NotFoundException('Not found.');
    }
  }

  public function update(UpdateProductRequest $request, $id)
  {
    try {
      $product = Product::findOrFail($id);
    } catch (\Exception $e) {
      throw new \App\Exceptions\NotFoundException('Not found.');
    }

    try {
      $data = $request->only([
        'title',
        'description',
        'price',
        'quantity'
      ]);
      if ($product->title === $data['title']) {
        unset($data['title']);
      }

      if ($request->hasFile('image')) {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
          Storage::disk('public')->delete($product->image);
        }
        $imagePath = $request->file('image')->store('images', 'public');
      }

      if ($request->has('pharmacies') && count($request->pharmacies) > 0) {
        foreach ($request->pharmacies as $pharmacyData) {
          $product->pharmacies()->attach($pharmacyData['id'], [
            'price' => $pharmacyData['price'] * 100,
            'quantity' => $pharmacyData['quantity'],
          ]);
        }
      }

      $product->update(array_merge($data, ['image' => $imagePath ?? $product->image]));

      return $product->fresh();
    } catch (\Exception $e) {
      throw new \App\Exceptions\QueryDBException('An error occurred while updating.');
    }
  }

  public function destroy($id)
  {
    try {
      $product = Product::findOrFail($id);
    } catch (\Exception $e) {
      throw new \App\Exceptions\NotFoundException('Not found.');
    }

    try {
      $product->delete();
    } catch (\Exception $e) {
      throw new \App\Exceptions\QueryDBException('An error occurred while deleting.');
    }

    return $product;
  }
}
