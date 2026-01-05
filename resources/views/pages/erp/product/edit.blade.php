@extends('layout.erp.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">

                <h3 class="mb-4">Edit Product</h3>

                <form action="{{ url('product/update/' . $product->id) }}" method="POST"
                      enctype="multipart/form-data" class="p-4 border rounded">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name"
                               value="{{ $product->name }}" placeholder="Enter product name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category ID</label>
                        <input type="number" class="form-control" name="category_id"
                               value="{{ $product->category_id }}" placeholder="Enter category id">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Manufacturer ID</label>
                        <input type="number" class="form-control" name="manufacturer_id"
                               value="{{ $product->manufacturer_id }}" placeholder="Enter manufacturer id">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Measure</label>
                        <input type="text" class="form-control" name="measure"
                               value="{{ $product->measure }}" placeholder="e.g. 500mg, 1 pcs">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <input type="text" class="form-control" name="type"
                               value="{{ $product->type }}" placeholder="Tablet / Syrup / Capsule">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Purchase Price</label>
                        <input type="number" step="0.01" class="form-control"
                               name="purchase_price" value="{{ $product->purchase_price }}"
                               placeholder="Enter purchase price">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Selling Price</label>
                        <input type="number" step="0.01" class="form-control"
                               name="selling_price" value="{{ $product->selling_price }}"
                               placeholder="Enter selling price">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Photo</label>
                        @if($product->photo)
                            <div class="mb-2">
                                <img src="{{ asset($product->photo) }}"
                                     class="img-fluid rounded" width="100" alt="Product photo">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="photo">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ url('product') }}" class="btn btn-secondary">Cancel</a>

                </form>

            </div>
        </div>
    </div>
@endsection
