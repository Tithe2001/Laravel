@extends('layout.erp.app')

@section('content')
<div class="content-wrapper">
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-10 mx-auto">

            <div class="card">
                <div class="card-body">

                    <!-- Invoice Header -->
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <h4 class="mb-1">Invoice</h4>
                            <p class="mb-0">Order ID: #{{ $order->id }}</p>
                            <p class="mb-0">Date: {{ $order->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="text-end">
                            <p class="mb-0"><strong>Customer ID:</strong> {{ $order->customer_id }}</p>
                            <p class="mb-0"><strong>Status:</strong> {{ $order->status_id }}</p>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->order_details as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->discount }}</td>
                                        <td>
                                            {{ ($item->qty * $item->price) - $item->discount }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <p><strong>Delivery Date:</strong> {{ $order->delivery_date }}</p>
                            <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>
                            <p><strong>Discount:</strong> {{ $order->discount }}</p>
                            <h5><strong>Net Amount:</strong> {{ $order->net_amount }}</h5>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <a href="{{ url('orders') }}" class="btn btn-secondary">
                            Back
                        </a>
                        <button onclick="window.print()" class="btn btn-primary">
                            Print Invoice
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection

