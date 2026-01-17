@extends('layout.erp.app')

@section('css')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }

    .invoice-box {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid mt-5 px-4 pt-5">
        <div class="invoice-box shadow-sm ms-lg-4">
            <div class="card shadow-sm mt-4 pt-3 ms-lg-4">
                <div class="card-body">

                    <form id="purchase_form" method="POST" action="{{ route('purchases.store') }}">
                        @csrf
                        <input type="hidden" name="supplier_id" id="form_supplier_id">
                        <input type="hidden" name="products" id="form_products">
                        <input type="hidden" name="total_amount" id="form_total_amount">
                        <input type="hidden" name="discount" id="form_discount">
                    </form>

                    <!-- Header -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4 class="fw-bold text-primary">FAST PHARMA</h4>
                            <p class="mb-0">123 Mirpur</p>
                            <p class="mb-0">Dhaka, Bangladesh</p>
                            <p class="mb-0">Phone: +880 1834-567890</p>
                        </div>

                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <h5 class="fw-bold">INVOICE</h5>
                            <p class="mb-0"><strong>Invoice #:</strong> INV-001</p>
                            <p class="mb-0"><strong>Date:</strong> {{ date('d M Y') }}</p>
                        </div>
                    </div>

                    <hr>

                    <!-- Supplier Info -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Supplier:</h6>
                            <select class="form-select mb-2" name="supplier" id="supplier_id">
                                <option value="">Select Supplier</option>
                                @forelse ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @empty
                                    <option value="">Data Not Found</option>
                                @endforelse
                            </select>

                            <textarea class="form-control supplier_address" style="height:40px" placeholder="Supplier address" readonly></textarea>
                            <textarea class="form-control supplier_email" style="height:40px" placeholder="Supplier email" readonly></textarea>
                        </div>
                    </div>

                    <!-- Invoice Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Discount</th>
                                    <th class="text-end">Subtotal</th>
                                    <th class="text-end">Action</th>
                                </tr>

                                <!-- Product Select Row -->
                                <tr>
                                    <th>
                                        <select class="form-select" id="product_id">
                                            <option value="">Select Product</option>
                                            @forelse ($products as $product)
                                                <option value='@json(["id" => $product->id, "name" => $product->name, "purchase_price" => $product->purchase_price])'>
                                                    {{ $product->name }}
                                                </option>
                                            @empty
                                                <option value="">Data Not Found</option>
                                            @endforelse
                                        </select>
                                    </th>

                                    <th class="text-end product_price">00</th>

                                    <th class="text-center">
                                        <input type="text" class="form-control product_qty" value="1">
                                    </th>

                                    <th class="text-end">
                                        <input type="text" class="form-control product_discount" value="0">
                                    </th>

                                    <th class="text-end">
                                        <input type="text" class="form-control product_subtotal" value="0">
                                    </th>

                                    <th class="text-end">
                                        <button class="btn btn-primary btn-sm" type="button" onclick="handle_add()">Add</button>
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="cart_items">
                                <!-- dynamic rows will be added here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Totals -->
                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <table class="table">
                                <tr>
                                    <th>Subtotal</th>
                                    <td class="text-end grand_subtotal">0.00</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td class="text-end grand_discount">0.00</td>
                                </tr>
                                <tr class="table-light">
                                    <th>Grand Total</th>
                                    <th class="text-end grand_total">0.00</th>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-4 no-print">
                        <button class="btn btn-secondary" onclick="purchase_submit()">Place Purchase</button>
                        <button class="btn btn-primary ms-2" onclick="window.print()">Print Invoice</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
let cart = [];

// Supplier Change
document.querySelector("#supplier_id").addEventListener("change", function() {
    let supplier_id = this.value;

    if (!supplier_id) {
        document.querySelector(".supplier_address").value = "";
        document.querySelector(".supplier_email").value = "";
        return;
    }

    fetch(`{{ url('supplier/find') }}/${supplier_id}`)
        .then(res => res.json())
        .then(data => {
            document.querySelector(".supplier_address").value = data.address;
            document.querySelector(".supplier_email").value = data.email;
        })
        .catch(err => console.log(err));
});

// Product Change
document.querySelector("#product_id").addEventListener("change", function() {
    let product = JSON.parse(this.value || '{}');
    if (!product.id) return;
    document.querySelector(".product_qty").value = 1;
    document.querySelector(".product_price").innerText = product.purchase_price;
    document.querySelector(".product_subtotal").value = product.purchase_price;
});

// Update subtotal
function update_subtotal() {
    let product = JSON.parse(document.querySelector("#product_id").value || '{}');
    if (!product.id) return;
    let qty = parseFloat(document.querySelector(".product_qty").value) || 0;
    let discount = parseFloat(document.querySelector(".product_discount").value) || 0;
    // let subtotal = (qty * product.purchase_price) - (qty * discount);
    let subtotal = (qty * product.purchase_price) - discount;
    document.querySelector(".product_subtotal").value = subtotal.toFixed(2);
}

document.querySelector(".product_qty").addEventListener("input", update_subtotal);
document.querySelector(".product_discount").addEventListener("input", update_subtotal);

// Add product to cart
function handle_add() {
    let product = JSON.parse(document.querySelector("#product_id").value);
    if (!product.id) return;

    let qty = parseFloat(document.querySelector(".product_qty").value) || 0;
    let discount = parseFloat(document.querySelector(".product_discount").value) || 0;
    // let subtotal = (qty * product.purchase_price) - (qty * discount);
    let subtotal = (qty * product.purchase_price) - discount;

    let p = {
        id: product.id,
        name: product.name,
        price: product.purchase_price,
        qty,
        discount,
        subtotal
    };


    let exists = cart.find(item => item.id == p.id);
if (exists) {
    // Merge quantity
    exists.qty += p.qty;
    // Merge discount correctly (discount per line, not per unit)
    exists.discount += p.discount;
    // Subtotal = (price * qty) - total line discount
    exists.subtotal = (exists.price * exists.qty) - exists.discount;
} else {
    cart.push(p);
}



    update_totals();
    render_cart();
}

// Render cart
function render_cart() {
    let html = "";
    cart.forEach(element => {
        html += `
            <tr>
                <td>${element.name}</td>
                <td>${element.price}</td>
                <td>${element.qty}</td>
                <td>${element.discount}</td>
                <td>${element.subtotal}</td>
                <td><button onclick="handle_delete(${element.id})" class="btn btn-danger btn-sm">Del</button></td>
            </tr>
        `;
    });
    document.querySelector("#cart_items").innerHTML = html;
}

// Delete item
function handle_delete(id) {
    cart = cart.filter(item => item.id != id);
    update_totals();
    render_cart();
}

// Update totals
function update_totals() {
    let total = 0, total_discount = 0, total_subtotal = 0;

   cart.forEach(item => {
    total_subtotal += item.price * item.qty;
    total_discount += item.discount; // just sum the total line discount
    total += item.subtotal; // subtotal already includes discount
});

    document.querySelector(".grand_total").innerText = total.toFixed(2);
    document.querySelector(".grand_discount").innerText = total_discount.toFixed(2);
    document.querySelector(".grand_subtotal").innerText = total_subtotal.toFixed(2);
}

// Submit Purchase
function purchase_submit() {
    document.querySelector("#form_supplier_id").value = document.querySelector("#supplier_id").value;
    document.querySelector("#form_products").value = JSON.stringify(cart);
    document.querySelector("#form_total_amount").value = parseFloat(document.querySelector(".grand_total").innerText);
    document.querySelector("#form_discount").value = parseFloat(document.querySelector(".grand_discount").innerText);
    document.querySelector("#purchase_form").submit();
}
</script>
@endpush
