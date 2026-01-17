<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    // List all purchases
    public function index()
    {
        $purchases = Purchase::with('supplier')->orderBy('id', 'desc')->get();
        return view('pages.erp.purchase.index', compact('purchases'));
    }

    // Show create form
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('pages.erp.purchase.purchase', compact('suppliers', 'products'));
    }

    // Store purchase
    // Store purchase
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            // Create purchase
            $purchase = new Purchase();
            $purchase->supplier_id = $request->supplier_id;
            $purchase->total_amount = $request->total_amount;
            $purchase->discount = $request->discount ?? 0; // default 0
            $purchase->purchase_date = now();
            $purchase->save();

            // Save details and update stock
            $products = json_decode($request->products, true);
            foreach ($products as $p) {
                $detail = new PurchaseDetail();
                $detail->purchase_id = $purchase->id;
                $detail->product_id = $p['id'];
                $detail->qty = $p['qty'];
                $detail->unit_price = $p['price'];
                $detail->discount = $p['discount'] ?? 0;
                // $detail->subtotal = ($p['price'] * $p['qty']) - $p['discount']; // REMOVE THIS
                $detail->save();


                // Update stock
                $stock = Stock::where('product_id', $p['id'])->first();
                if ($stock) {
                    $stock->qty += $p['qty'];
                    $stock->save();
                } else {
                    Stock::create([
                        'product_id' => $p['id'],
                        'qty' => $p['qty'],
                        'transaction_id' => $purchase->id,
                    ]);
                }
            }
        });

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully!');
    }

    // Update purchase
    public function update(Request $request, Purchase $purchase)
    {
        DB::transaction(function () use ($request, $purchase) {

            // Revert old stock
            foreach ($purchase->details as $detail) {
                $stock = Stock::where('product_id', $detail->product_id)->first();
                if ($stock) {
                    $stock->qty -= $detail->qty;
                    $stock->save();
                }
            }

            // Update purchase
            $purchase->supplier_id = $request->supplier_id;
            $purchase->total_amount = $request->total_amount;
            $purchase->discount = $request->discount ?? 0;
            $purchase->purchase_date = $request->purchase_date;
            $purchase->save();

            // Delete old details
            $purchase->details()->delete();

            // Save new details and update stock
            $products = json_decode($request->products, true);
            foreach ($products as $p) {
                $detail = new PurchaseDetail();
                $detail->purchase_id = $purchase->id;
                $detail->product_id = $p['id'];
                $detail->qty = $p['qty'];
                $detail->unit_price = $p['price']; // use unit_price
                $detail->discount = $p['discount'] ?? 0;
                $detail->subtotal = ($p['price'] * $p['qty']) - $detail->discount;
                $detail->save();

                // Update stock
                $stock = Stock::where('product_id', $p['id'])->first();
                if ($stock) {
                    $stock->qty += $p['qty'];
                    $stock->save();
                } else {
                    Stock::create([
                        'product_id' => $p['id'],
                        'qty' => $p['qty'],
                        'transaction_id' => $purchase->id,
                    ]);
                }
            }
        });

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully!');
    }


    // Show purchase invoice
    public function show(Purchase $purchase)
    {
        $purchase->load('supplier', 'details.product');
        return view('pages.erp.purchase.purchaseDetail', compact('purchase'));
    }


    // Edit purchase
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $purchase->load('details.product');
        return view('pages.erp.purchase.edit', compact('purchase', 'suppliers', 'products'));
    }

    // Update purchase


    // Delete purchase
    public function destroy(Purchase $purchase)
    {
        DB::transaction(function () use ($purchase) {
            // Revert stock
            foreach ($purchase->details as $detail) {
                $stock = Stock::where('product_id', $detail->product_id)->first();
                if ($stock) {
                    $stock->qty -= $detail->qty;
                    $stock->save();
                }
            }

            // Delete details and purchase
            $purchase->details()->delete();
            $purchase->delete();
        });

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }
}
