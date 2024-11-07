@extends('layout')

@section('content')
    <div class="container mt-4">
        <h2>Edit Pharmacy</h2>
        <form action="{{ route('pharmacies.update', $pharmacy->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- To indicate the PUT method for updating -->

            <!-- Pharmacy Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $pharmacy->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pharmacy Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" value="{{ old('address', $pharmacy->address) }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Update Pharmacy</button>
            </div>
        </form>
    </div>
@endsection
