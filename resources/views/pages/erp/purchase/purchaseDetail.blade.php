@extends('layout.erp.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">

            <h3 class="mb-4">Purchase Invoice</h3>

            <div class="p-4 border rounded">

                <!-- Header -->
                <div class="mb-3">
                    <strong>Invoice #:</strong> INV-{{ $purchase->id }}<br>
                    <strong>Date:</strong> {{ date('d M Y', strtotime($purchase->purchase_date)) }}
                </div>

                <!-- Supplier Info -->
                <div class="mb-3">
                    <strong>Supplier:</strong> {{ $purchase->supplier->name ?? '-' }}<br>
                    <strong>Address:</strong> {{ $purchase->supplier->address ?? '-' }}<br>
                    <strong>Email:</strong> {{ $purchase->supplier->email ?? '-' }}
                </div>

                <!-- Purchase Details Table -->
                <div class="table-responsive mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-end">Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Discount</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase->details as $detail)
                            <tr>
                                <td>{{ $detail->product->name ?? '-' }}</td>
                                <td class="text-end">{{ $detail->unit_price }}</td>
                                <td class="text-center">{{ $detail->qty }}</td>
                                <td class="text-end">{{ $detail->discount ?? 0 }}</td>
                               <td class="text-end">{{ ($detail->unit_price * $detail->qty) - $detail->discount }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total Amount</th>
                                <th class="text-end">{{ $purchase->total_amount }}</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Discount</th>
                                <th class="text-end">{{ $purchase->discount }}</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Net Amount</th>
                                <th class="text-end">{{ $purchase->total_amount - $purchase->discount }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Notes -->
                @if($purchase->notes)
                <div class="mb-3">
                    <strong>Notes:</strong>
                    <p>{{ $purchase->notes }}</p>
                </div>
                @endif

                <!-- Footer -->
                <div class="text-center">
                    <button class="btn btn-primary" onclick="window.print()">Print Invoice</button>
                    <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Back to List</a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
