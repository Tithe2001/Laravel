@extends('layout.erp.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid px-4 pt-4">

        <h3 class="mb-4">Purchase List</h3>

        <div>
            <a href="{{ url('purchases/create') }}" class="btn btn-primary">
                Create Purchase
            </a>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped align-middle text-center mb-0">
                        <thead class="table-white text-dark">
                            <tr>
                                <th width="5%">ID</th>
                                <th>Supplier</th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Net Amount</th>
                                <th>Date</th>
                                <th width="18%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->id }}</td>
                                    <td>{{ $purchase->supplier->name ?? '-' }}</td>
                                    <td>{{ $purchase->total_amount }}</td>
                                    <td>{{ $purchase->discount }}</td>
                                    <td>{{ $purchase->total_amount - $purchase->discount }}</td>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>
                                        <!-- Invoice -->
                                        <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-info btn-sm">Invoice</a>

                                        <!-- Edit -->
                                        <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                        <!-- Delete -->
                                        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
