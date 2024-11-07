@extends('layout')

@section('content')
    <div class="container mt-4">
        <h2>Create Product</h2>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Product Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pharmacies & Price/Quantity -->
            <div class="mb-3">
                <label for="pharmacies" class="form-label">Pharmacies</label>
                <div id="pharmacy-fields">
                </div>
                <button type="button" class="btn btn-primary" id="add-pharmacy">Add Pharmacy</button>
            </div>

            <!-- Submit Button -->
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Create Product</button>
            </div>
        </form>
    </div>
@endsection

@section('extra-js')
    <script>
        // Add new pharmacy fields dynamically
        document.getElementById('add-pharmacy').addEventListener('click', function() {
            var pharmacyFields = document.getElementById('pharmacy-fields');
            var newFieldIndex = pharmacyFields.children.length;

            var newField = document.createElement('div');
            newField.classList.add('row', 'mb-3');
            newField.innerHTML = `
            <div class="col-md-5">
                <input class="form-control" type="text" name="pharmacies[${newFieldIndex}][id]" />
                <div id="searchHelp" class="form-text">Type pharmacy id.</div>
            </div>
            <div class="col-md-3">
                <input type="number" step="0.01" class="form-control" name="pharmacies[${newFieldIndex}][price]" placeholder="Price">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="pharmacies[${newFieldIndex}][quantity]" placeholder="Quantity">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-pharmacy">Remove</button>
            </div>
        `;
            pharmacyFields.appendChild(newField);

            // Remove the pharmacy field when the "Remove" button is clicked
            newField.querySelector('.remove-pharmacy').addEventListener('click', function() {
                newField.remove();
            });
        });
    </script>
@endsection
