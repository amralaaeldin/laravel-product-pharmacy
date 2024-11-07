@extends('layout')

@section('content')
    <main>
        <h1>Pharmacies</h1>

        <a href="/pharmacies/create" class="text-white btn btn-success w-25"
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
                    <th scope="col">Name</th>
                    <th scope="col">Addess</th>
                </tr>
            </thead>
            <tbody>
                @if ($pharmacies->count() > 0)
                    @foreach ($pharmacies as $pharmacy)
                        <tr>
                            <th scope="row">{{ $pharmacy->id }} </th>
                            <td>{{ $pharmacy->name }}</td>
                            <td>
                                <a href="{{ route('pharmacies.edit', $pharmacy->id) }}" class="btn btn-primary">Edit</a>
                                <form action="/pharmacies/{{ $pharmacy->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No pharmacies found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <nav class='d-flex' aria-label="Page navigation">
            <ul class="pagination w-25">
                <!-- Previous Button -->
                <li class="page-item {{ $pharmacies->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="{{ $pharmacies->currentPage() > 1 ? $pharmacies->path() . '?page=' . ($pharmacies->currentPage() - 1) . '&count=' . $pharmacies->perPage() : '#' }}">Previous</a>
                </li>

                <!-- Next Button -->
                <li class="page-item {{ $pharmacies->currentPage() == $pharmacies->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="{{ $pharmacies->currentPage() < $pharmacies->lastPage() ? $pharmacies->path() . '?page=' . ($pharmacies->currentPage() + 1) . '&count=' . $pharmacies->perPage() : '#' }}">Next</a>
                </li>
            </ul>

            <!-- Items per Page Selector -->
            <label for="perPage" class="mr-2">Items per page:</label>
            <ul class="pagination w-25">
                <li class="page-item ml-3 btn">
                    <a href="{{ $pharmacies->path() . '?page=' . $pharmacies->currentPage() . '&count=10' }}">10</a>
                </li>
                <li class="page-item ml-3 btn">
                    <a href="{{ $pharmacies->path() . '?page=' . $pharmacies->currentPage() . '&count=25' }}">25</a>
                </li>
                <li class="page-item ml-3 btn">
                    <a href="{{ $pharmacies->path() . '?page=' . $pharmacies->currentPage() . '&count=50' }}">50</a>
                </li>
                <li class="page-item ml-3 btn">
                    <a href="{{ $pharmacies->path() . '?page=' . $pharmacies->currentPage() . '&count=100' }}">100</a>
                </li>
            </ul>
        </nav>
    </main>
@endsection
