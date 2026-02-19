<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
       $orders = Order::all();
        return response()->json(compact("orders"), 200);
    }


    public function store(Request $request)
{
    $request->validate([
        'delivery_address' => 'required|string',
        'payment_method' => 'required|string',
        'products' => 'required|array',
    ]);

    $customerId = auth()->id() ?? 11;

    $total = collect($request->products)
        ->sum(fn($p) => $p['selling_price'] * $p['qty']);

    $discount = 0;
    $netAmount = $total - $discount;

    // Create order
    $order = Order::create([
        'customer_id'      => $customerId,
        'total_amount'     => $total,
        'discount'         => $discount,
        'net_amount'       => $netAmount,
        'status_id'        => 1,
        'delivery_date'    => null,
        'delivery_address' => $request->delivery_address,
    ]);

    // Insert item rows
    foreach ($request->products as $item) {
        OrderDetail::create([
            'order_id'  => $order->id,
            'product_id'=> $item['id'],
            'qty'       => $item['qty'],
            'price'     => $item['selling_price'],
            'discount'  => 0,
        ]);
    }

    return response()->json([
        'message' => 'Order placed successfully!',
        'order_id' => $order->id
    ], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
