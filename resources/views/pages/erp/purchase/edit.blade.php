@extends('layout.erp.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">

            <h3 class="mb-4">Edit Purchase</h3>

            <form action="{{ route('purchases.update', $purchase->id) }}"
                  method="POST"
                  class="p-4 border rounded">
                @csrf
                @method('PUT') <!-- important! tells Laravel this is a PUT request -->

                <div class="mb-3">
                    <label class="form-label">Supplier</label>
                    <select class="form-select" name="supplier_id">
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="number" step="0.01" class="form-control"
                           name="total_amount"
                           value="{{ $purchase->total_amount }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Discount</label>
                    <input type="number" step="0.01" class="form-control"
                           name="discount"
                           value="{{ $purchase->discount }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Net Amount</label>
                    <input type="number" step="0.01" class="form-control"
                           name="net_amount"
                           value="{{ $purchase->total_amount - $purchase->discount }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Purchase Date</label>
                    <input type="date" class="form-control"
                           name="purchase_date"
                           value="{{ date('Y-m-d', strtotime($purchase->purchase_date)) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control"
                              name="notes"
                              rows="3">{{ $purchase->notes ?? '' }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Purchase
                </button>

                <a href="{{ route('purchases.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>
</div>
@endsection
