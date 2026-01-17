<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        // $customers = Customer::all();
        // $products = Product::all();

        // return view("pages.erp.order.order", compact("customers", "products"));

 $orders = Order::latest()->get();
    return view('pages.erp.order.index', compact('orders'));







    }

    public function create() {
         $customers = Customer::all();
        $products = Product::all();

        return view("pages.erp.order.order", compact("customers", "products"));
    }

public function store(Request $request)
{
    $products = json_decode($request->product, true); // decode JSON array

    if (!$products || count($products) == 0) {
        return redirect()->back()->with('error', 'No products added to the order.');
    }

    // Calculate totals
    $total_amount = 0;
    $total_discount = 0;

    foreach ($products as $p) {
        $total_amount += $p['price'] * $p['qty'];
        $total_discount += $p['discount'] * $p['qty'];
    }

    $net_amount = $total_amount - $total_discount;

    // Create order
    $order = new Order();
    $order->customer_id = $request->customer_id;
    $order->total_amount = $total_amount ?: 0; // default 0 if calculation fails
    $order->discount = $total_discount ?: 0;
    $order->net_amount = $net_amount ?: 0;
    $order->status_id = 1; // default: pending
    $order->delivery_date = now(); // default today
    $order->delivery_address = "Not Provided"; // default placeholder
    $order->save();

    // Save order details
    foreach ($products as $p) {
        $order_detail = new OrderDetail();
        $order_detail->order_id = $order->id;
        $order_detail->product_id = $p['id'];
        $order_detail->qty = $p['qty'];
        $order_detail->price = $p['price'];
        $order_detail->discount = $p['discount'];
        $order_detail->save();
    }
   
// Update stock
$stock = Stock::where('product_id', $p['id'])->first();
if ($stock) {
    $stock->qty -= $p['qty']; // reduce stock
    if ($stock->qty < 0) $stock->qty = 0; // prevent negative stock
    $stock->save();
}



    return redirect()->route('orders.index')
                     ->with('success', 'Order created successfully');
}







    // public function show(Order $order){
   public function show($id)
{
    $order = Order::with(['customer', 'order_details.product'])
                  ->findOrFail($id);

    // return $order;
    return view('pages.erp.order.orderDetail', compact('order'));
}


   public function edit($id)
{
    $order = Order::findOrFail($id);
    return view('pages.erp.order.edit', compact('order'));
}
public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $order->customer_id = $request->customer_id;
    $order->total_amount = $request->total_amount;
    $order->discount = $request->discount;
    $order->net_amount = $request->net_amount;
    $order->status_id = $request->status_id;
    $order->delivery_date = $request->delivery_date;
    $order->delivery_address = $request->delivery_address;

    $order->save();

    return redirect()
    ->route('orders.show', $order->id)
    ->with('success', 'Order updated successfully');

}

   public function destroy(Order $order)
{
    $order->delete();

    return redirect()
        ->route('orders.index')
        ->with('success', 'Order deleted successfully');
}


}
