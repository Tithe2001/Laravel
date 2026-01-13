@extends('layout.erp.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">

            <h3 class="mb-4">Edit Order</h3>

            <form action="{{ route('orders.update', $order->id) }}"  
                  method="POST"
                  class="p-4 border rounded">
                @csrf
                @method('PUT') <!-- important! tells Laravel this is a PUT request -->

                <div class="mb-3">
                    <label class="form-label">Customer ID</label>
                    <input type="number" class="form-control"
                           name="customer_id"
                           value="{{ $order->customer_id }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="number" step="0.01" class="form-control"
                           name="total_amount"
                           value="{{ $order->total_amount }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Discount</label>
                    <input type="number" step="0.01" class="form-control"
                           name="discount"
                           value="{{ $order->discount }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Net Amount</label>
                    <input type="number" step="0.01" class="form-control"
                           name="net_amount"
                           value="{{ $order->net_amount }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status ID</label>
                    <input type="number" class="form-control"
                           name="status_id"
                           value="{{ $order->status_id }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Delivery Date</label>
                    <input type="date" class="form-control"
                           name="delivery_date"
                           value="{{ $order->delivery_date }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Delivery Address</label>
                    <textarea class="form-control"
                              name="delivery_address"
                              rows="3">{{ $order->delivery_address }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Order
                </button>

                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>
</div>
@endsection
