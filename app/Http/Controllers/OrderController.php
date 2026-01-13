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

    $order = new Order();
    $order->customer_id = $request->customer_id;
    $order->save();

    foreach ($products as $p) {
        $order_detail = new OrderDetail();
        $order_detail->order_id = $order->id;
        $order_detail->product_id = $p['id'];
        $order_detail->qty = $p['qty'];
        $order_detail->price = $p['price'];
        $order_detail->discount = $p['discount'];
        $order_detail->save();
    }

    // return redirect()->route('orders.show', $order->id)
    //                  ->with('success', 'Order created successfully');
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
