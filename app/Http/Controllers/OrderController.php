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
   public function index(){
    $customers= Customer::all();
    $products= Product::all();

 return view("pages.erp.invoice.order", compact("customers", "products"));

   }

public function create(){

}

public function store(Request $request){

        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->order_date = now();
        $order->save();

            foreach ($request->product as $key => $p) {
            $order_details = new OrderDetail();
            $order_details->order_id = $order->id;
            $order_details->product_id = $p['id'];
            $order_details->qty = $p['qty'];
            $order_details->price = $p['price'];
            $order_details->discount = $p['discount'];
            $order_details->save();



            $stock = new Stock();
            $stock->product_id = $p['id'];
            $stock->qty = $p['qty'] * -1;
            $stock->transaction_id = 1;
            $stock->warehouse_id = 1;

            $stock->save();


            
            }




}



// public function show(Order $order){
public function show($id){

return view("pages.erp.invoice.orderDetail");

$order= Order::with(["customer", "order_detail", "order_detail.product"])->find($id);
 return view("pages.erp.invoice.orderDetail", compact("order"));



}

public function edit(Order $order){

}

public function update(Request $request, Order $order){

}

public function destroy(Order $order){

}













}
