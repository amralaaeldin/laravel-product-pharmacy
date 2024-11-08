@extends('layout')

@section('content')
    <main>
        <h1>Products</h1>

        <div class="d-flex gap-5">
            <form action="/products" method="GET" id="searchForm" class='w-75'>
                <div class="mb-3">
                    <label for="search" class="form-label">Search Products</label>
                    <input minlength="2" type="text" class="form-control" id="search" name="search"
                        aria-describedby="searchHelp" placeholder="Enter product name" value="{{ request('search') }}">
                    <div id="searchHelp" class="form-text">Type at least 2 letters to search.</div>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>


            <a href="/products/create" class="text-white btn btn-success w-25"
                style="height: 38px;
            margin-top: 30px;
            text-decoration: none; color: white;">
                Create
            </a>
        </div>


        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }} </th>
                            <td>{{ $product->title }}</td>
                            <td><img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                                    alt="{{ $product->title }}" style="width: 100px;">
                            </td>
                            <td>
                                <a href="/products/{{ $product->id }}" class="btn btn-primary">View</a>
                                <form action="/products/{{ $product->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No products found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <nav class='d-flex' aria-label="Page navigation">
            <ul class="pagination w-25">
                <!-- Previous Button -->
                <li class="page-item {{ $products->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="{{ $products->currentPage() > 1 ? $products->path() . '?page=' . ($products->currentPage() - 1) . '&count=' . $products->perPage() : '#' }}">Previous</a>
                </li>

                <!-- Next Button -->
                <li class="page-item {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="{{ $products->currentPage() < $products->lastPage() ? $products->path() . '?page=' . ($products->currentPage() + 1) . '&count=' . $products->perPage() : '#' }}">Next</a>
                </li>
            </ul>

            <!-- Items per Page Selector -->
            <label for="perPage" class="mr-2">Items per page:</label>
            <ul class="pagination w-25">
                <li class="page-item ml-3 btn">
                    <a href="{{ $products->path() . '?page=' . $products->currentPage() . '&count=10' }}">10</a>
                </li>
                <li class="page-item ml-3 btn">
                    <a href="{{ $products->path() . '?page=' . $products->currentPage() . '&count=25' }}">25</a>
                </li>
                <li class="page-item ml-3 btn">
                    <a href="{{ $products->path() . '?page=' . $products->currentPage() . '&count=50' }}">50</a>
                </li>
                <li class="page-item ml-3 btn">
                    <a href="{{ $products->path() . '?page=' . $products->currentPage() . '&count=100' }}">100</a>
                </li>
            </ul>
        </nav>
    </main>
@endsection
