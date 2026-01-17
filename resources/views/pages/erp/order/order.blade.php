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
                    <div class="card-body ">


                        <form id="order_form" method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <input type="hidden" name="customer_id" id="form_customer_id">
                            <input type="hidden" name="product" id="form_product">
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
                                <p class="mb-0"><strong>Date:</strong> 06 Jan 2026</p>
                            </div>
                        </div>

                        <hr>

                        <!-- Billing Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Billed To:</h6>

                                <select class="form-select mb-2" name="customer" id="customer_id">
                                    <option value="">Select Customer</option>
                                    @forelse ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @empty
                                        <option value="">Data Not Found</option>
                                    @endforelse
                                </select>

                                <textarea class="form-control customer_address" style="height:40px" placeholder="Customer address" readonly></textarea>
                                <textarea class="form-control customer_email" style="height:40px" placeholder="Customer email" readonly></textarea>
                            </div>

                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <h6 class="fw-bold">Payment Method</h6>
                                <p class="mb-0">Cash / Bank / Mobile Banking</p>
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
                                            <select class="form-select" name="product" id="product_id">
                                                <option value="">Select Product</option>
                                                @forelse ($products as $product)
                                                    <option value='@json(['id' => $product->id, 'name' => $product->name, 'selling_price' => $product->selling_price])'>
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
                                            <button class="btn btn-primary btn-sm" type="button"
                                                onclick="handle_add()">Add</button>
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
                        <div class="text-center mt-4">
                            <p class="text-muted mb-1"> <button onclick="order_submit()" class="btn btn-secondary">Place
                                    Order</button></p>
                        </div>
                        <div class="text-center mt-3 no-print">
                            <button class="btn btn-primary me-2" onclick="window.print()">Print Invoice</button>
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

        // customer Change
        document.querySelector("#customer_id").addEventListener("change", function() {
            let customer_id = this.value;

            if (!customer_id) {
                document.querySelector(".customer_address").value = "";
                document.querySelector(".customer_email").innerText = "";
                return;
            }

            fetch(`{{ url('customer/find') }}/${customer_id}`)
                .then(res => res.json())
                .then(data => {
                    document.querySelector(".customer_address").value = data.address;
                    document.querySelector(".customer_email").value = data.email;

                })
                .catch(err => console.log(err));
        });


        // product change
        document.querySelector("#product_id").addEventListener("change", function() {
            let product = JSON.parse(this.value);
            document.querySelector(".product_qty").value = 1;
            document.querySelector(".product_price").innerText = product.selling_price;
            document.querySelector(".product_subtotal").value = product.selling_price;
        });




        // Auto-update subtotal when qty or discount changes
        function update_subtotal() {
            let product = JSON.parse(document.querySelector("#product_id").value || '{}');
            if (!product.id) return;

            let qty = parseFloat(document.querySelector(".product_qty").value) || 0;
            let discount = parseFloat(document.querySelector(".product_discount").value) || 0;

            let subtotal = (qty * product.selling_price) - (qty * discount);
            document.querySelector(".product_subtotal").value = subtotal.toFixed(2);
        }

        // Listen for qty and discount input changes
        document.querySelector(".product_qty").addEventListener("input", update_subtotal);
        document.querySelector(".product_discount").addEventListener("input", update_subtotal);










        function handle_add() {
            let product = JSON.parse(document.querySelector("#product_id").value);
            let qty = parseFloat(document.querySelector(".product_qty").value) || 0;
            let discount = parseFloat(document.querySelector(".product_discount").value) || 0;
            let subtotal = (qty * product.selling_price) - (qty * discount);

            let p = {
                id: product.id,
                name: product.name,
                price: product.selling_price,
                qty,
                discount,
                subtotal
            };

            let exists = cart.find(item => item.id == p.id);
            if (exists) {
                exists.qty += p.qty;
                exists.subtotal = (exists.qty * exists.price) - (exists.qty * exists.discount);
            } else {
                cart.push(p);
            }

            // Totals
            let total = 0;
            let total_discount = 0;
            let total_subtotal = 0;

            cart.forEach(item => {
                total += item.subtotal;
                total_discount += item.discount * item.qty; // per unit discount
                total_subtotal += item.price * item.qty;
            });

            document.querySelector(".grand_total").innerText = total.toFixed(2);
            document.querySelector(".grand_discount").innerText = total_discount.toFixed(2);
            document.querySelector(".grand_subtotal").innerText = total_subtotal.toFixed(2);

            print();
        }

        function print() {
            let html = "";
            cart.forEach(element => {
                html += `
                <tr>
                    <td>${element.name}</td>
                    <td>${element.price}</td>
                    <td>${element.qty}</td>
                    <td>${element.discount}</td>
                    <td>${element.subtotal}</td>
                    <td><button onclick="handle_delete(${element.id})" class="btn btn-danger">Del</button></td>
                </tr>
            `;
            });
            document.querySelector("#cart_items").innerHTML = html;
        }

        function handle_delete(id) {
            cart = cart.filter(item => item.id != id);
            print();
        }


        //    function order_submit() {
        //     // fill hidden form
        //     document.querySelector("#form_customer_id").value = document.querySelector("#customer_id").value;
        //     document.querySelector("#form_product").value = JSON.stringify(cart);

        //     document.querySelector("#order_form").submit();
        // }

        function order_submit() {
            document.querySelector("#form_customer_id").value = document.querySelector("#customer_id").value;
            document.querySelector("#form_product").value = JSON.stringify(cart);
            document.querySelector("#order_form").submit();
        }
    </script>
@endpush
