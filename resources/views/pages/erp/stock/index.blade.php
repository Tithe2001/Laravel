@extends('layout.erp.app')

@section('css')
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
<div class="content-wrapper">
<div class="container-fluid mt-5 px-4 pt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Stock List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Transaction ID</th>
                            <th>Parent ID</th>
                            <th>Warehouse</th>
                            <th>Expiry Date</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stocks as $stock)
                        <tr>
                            <td>{{ $stock->id }}</td>
                            <td>{{ $stock->product->name ?? 'Unknown' }}</td>
                            <td>{{ $stock->qty }}</td>
                            <td>{{ $stock->transaction_id ?? '-' }}</td>
                            <td>{{ $stock->parent_id ?? '-' }}</td>
                            <td>{{ $stock->warehouse_id ?? '-' }}</td>
                            <td>{{ $stock->expiry_date ?? '-' }}</td>
                            <td>{{ $stock->created_at }}</td>
                            <td>{{ $stock->updated_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No stock found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
