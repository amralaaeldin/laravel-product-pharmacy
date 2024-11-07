<?php

namespace App\Http\Controllers;

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
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->store($request);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = $this->productService->show($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productService->show($id);
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $this->productService->update($request, $id);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $this->productService->destroy($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
