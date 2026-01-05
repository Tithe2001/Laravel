@extends('layout.erp.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid px-4 pt-4">

            <h3 class="mb-4">Product List</h3>

            <div>
                <a href="{{ url('product/create') }}" class="btn btn-primary">
                    Create Product
                </a>
                <form action="{{ url('product.index') }}" method="GET" class="d-none">
                            @csrf
                        </form>

            </div>

            <div class="card mt-3">
                <div class="card-body">

                    <div class="table-responsive">

                        <!-- Search Form -->
                        <form action="{{ url('product') }}" method="GET">
                            <div class="mb-3 d-flex gap-2">
                                <input value="{{ request('search') }}" type="text"
                                    class="form-control" name="search" placeholder="Search product">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>

                        <!-- Table -->
                        <table class="table table-bordered table-striped align-middle text-center mb-0">
                            <thead class="table-white text-dark">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Name</th>
                                    <th width="10%">Photo</th>
                                    <th>Category</th>
                                    <th>Manufacturer</th>
                                    <th>Measure</th>
                                    <th>Type</th>
                                    <th>Purchase</th>
                                    <th>Selling</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <img src="{{ $product->photo }}"
                                                class="img-fluid rounded" width="50">
                                        </td>
                                        <td>{{ $product->category_id }}</td>
                                        <td>{{ $product->manufacturer_id }}</td>
                                        <td>{{ $product->measure }}</td>
                                        <td>{{ $product->type }}</td>
                                        <td>{{ $product->purchase_price }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>
                                            <a href="{{ url('product/edit/' . $product->id) }}"
                                                class="btn btn-sm btn-secondary">
                                                Edit
                                            </a>

                                            <form action="{{ url('product/delete/' . $product->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')"
                                                    class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
