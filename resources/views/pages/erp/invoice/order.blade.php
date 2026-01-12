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

 <div class="container mt-5 pt-5 pt-md-4" >

     <div class="invoice-box shadow-sm ms-lg-4">
        <div class="card shadow-sm mt-4 pt-3 ms-lg-4">
            <div class="card-body">

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

                        <p class="mb-0 customer_address">Customer Address</p>
                        <p>Email: <span class="customer_email">customer@email.com</span></p>
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

                            <!-- Column Header -->
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
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
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
                                    <button class="btn btn-primary btn-sm">Add</button>
                                </th>
                            </tr>

                        </thead>

                        <!-- Cart Items -->
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
                                <td class="text-end grand_subtotal">0</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td class="text-end grand_discount">0</td>
                            </tr>
                            <tr class="table-light">
                                <th>Grand Total</th>
                                <th class="text-end grand_total">0</th>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-4">
                    <p class="text-muted mb-1"> <button onclick="order_submit()" class="btn btn-secondary">Place
                            Order</button>
                    </p>
                </div>
                <!-- Buttons -->
                <div class="text-center mt-3 no-print">

                    <button class="btn btn-primary me-2" onclick="window.print()">Print Invoice</button>
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

            fetch(`{{ URL('customer/find') }}/ ${customer_id}`, )
                .then(res => {
                    console.log(res);
                    return res.json();
                })
                .then(data => {
                    console.log(data);
                    document.querySelector(".customer_email").innerText = data.email
                    document.querySelector(".customer_address").innerText = data.name
                })
                .catch(error => {
                    console.log(error);
                })

        })

        // product change

        document.querySelector("#product_id").addEventListener("change", function() {
            let product = JSON.parse(this.value);
            document.querySelector(".product_qty").value = 2;
            document.querySelector(".product_price").innerText = product.offer_price;
            document.querySelector(".product_subtotal").value = product.offer_price;

        })

        function handle_add() {
            let product = JSON.parse(document.querySelector("#product_id").value)
            let qty = parseFloat(document.querySelector(".product_qty").value);
            let discount = parseFloat(document.querySelector(".product_discount").value);
            let subtotal = (qty * product.offer_price) - (qty * discount);

            let p = {
                id: product.id,
                name: product.name,
                price: product.offer_price,
                qty,
                discount,
                subtotal
            }

            let exists = cart.find(item => item.id == p.id);
            if (exists) {
                exists.qty += p.qty;
                exists.subtotal = (exists.qty * exists.price) - (exists.qty * exists.discount);
            } else {
                cart.push(p);
            }


            let total_reduce = cart.reduce((acc, item) => parseFloat(item.subtotal) + acc, 0);


            // console.log(cart);

            let total = 0;
            let total_discount = 0;
            let total_subtotal = 0;


            cart.forEach(item => {
                total += item.subtotal;
                total_discount += item.discount;
                total_subtotal += item.price * item.qty;
            });


            console.log("total_reduce", total_reduce);
            console.log("total", total);
            console.log("total_discount", total_discount);

            document.querySelector(".grand_total").innerText = total
            document.querySelector(".grand_discount").innerText = total_discount
            document.querySelector("grand_subtotal").innerText =

                print()
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
                    <td> <button onclick="handle_delete(${element.id})" class="btn btn-danger">Del</button> </td>

                </tr>

       `;
            });

            document.querySelector("#cart_items").innerHTML = html
            // console.log(html);

        }

        function handle_delete(id) {
            cart = cart.filter(item => item.id != id);
            print()
        }
    </script>
@endpush
