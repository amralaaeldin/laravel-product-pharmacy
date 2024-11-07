<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->index();
        return response()->json($products);
    }

    public function store(StoreProductRequest $request)
    {
        $createdProduct = $this->productService->store($request);
        return response()->json($createdProduct);
    }

    public function show($id)
    {
        $product = $this->productService->show($id);
        return response()->json($product);
    }

    public function update(UpdateProductRequest $request,  $id)
    {
        $updatedProduct = $this->productService->update($request, $id);
        return response()->json($updatedProduct);
    }

    public function destroy($id)
    {
        $deletedProduct = $this->productService->destroy($id);
        return response()->json($deletedProduct);
    }
}
