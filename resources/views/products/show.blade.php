@extends('layout')

@section('content')
    <main>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                        alt="{{ $product->title }}" alt="{{ $product->title }}" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h2>{{ $product->title }}</h2>
                    <p class="text-muted">{{ $product->description }}</p>

                    <!-- Action Buttons -->
                    <div class="mt-3">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit Product</a>
                    </div>
                </div>
            </div>

            <table class="table table-responsive m-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($product->pharmacies->count() > 0)
                        @foreach ($product->pharmacies as $pharmacy)
                            <tr>
                                <th scope="row">{{ $pharmacy->id }} </th>
                                <td>{{ $pharmacy->name }}</td>
                                <td>{{ $pharmacy->address }}</td>
                                <td><strong>{{ $pharmacy->price }}$</strong></td>
                                <td>{{ $pharmacy->pivot->quantity }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No pharmacies found</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
</main @endsection
