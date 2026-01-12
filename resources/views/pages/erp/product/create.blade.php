@extends('layout.erp.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">

                <h3 class="mb-4">Add New Product</h3>

                <form action="{{ URL('product/save') }}" method="POST" enctype="multipart/form-data"
                    class="p-4 border rounded">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter product name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category ID</label>
                        <input type="number" class="form-control" name="category_id" placeholder="Enter category id">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Manufacturer ID</label>
                        <input type="number" class="form-control" name="manufacturer_id"
                            placeholder="Enter manufacturer id">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Measure</label>
                        <input type="text" class="form-control" name="measure" placeholder="e.g. 500mg, 1 pcs">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select" name="type">
                            <option value="" selected disabled>Select Type</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Capsule">Capsule</option>
                            <option value="Injection">Injection</option>
                            <option value="Cream">Cream</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Purchase Price</label>
                        <input type="number" step="0.01" class="form-control" name="purchase_price"
                            placeholder="Enter purchase price">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Selling Price</label>
                        <input type="number" step="0.01" class="form-control" name="selling_price"
                            placeholder="Enter selling price">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Product</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>

                </form>

            </div>
        </div>
    </div>
@endsection
