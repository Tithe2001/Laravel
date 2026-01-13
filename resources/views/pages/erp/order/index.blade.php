@extends('layout.erp.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid px-4 pt-4">

            <h3 class="mb-4">Order List</h3>

            <div>
                <a href="{{ url('orders/create') }}" class="btn btn-primary">
                    Create Order
                </a>
            </div>

            <div class="card mt-3">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped align-middle text-center mb-0">
                            <thead class="table-white text-dark">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Net Amount</th>
                                    <th>Status</th>
                                    <th>Delivery Date</th>
                                    <th width="18%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer_id }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->net_amount }}</td>
                                        <td>{{ $order->status_id }}</td>
                                        <td>{{ $order->delivery_date }}</td>
                                        <td>
                                            <!-- Show/Invoice -->
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Invoice</a>

                <!-- Edit -->
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <!-- Delete -->
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
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
