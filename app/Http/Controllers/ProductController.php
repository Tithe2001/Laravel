<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
   function index(Request $request)
    {
        // return view("pages.erp.product.index");

        // get all products
        $product = DB::table("products")->get();

        // search
        $product = Product::when($request->search, function ($query) use ($request) {
            return $query->whereAny([
                "name",
                "id",
                "type",
                "measure",
            ], "LIKE", "%" . $request->search . "%");
        })->get();

        return view("pages.erp.product.index", [
            "products" => $product
        ]);
    }

    function create()
{
    return view('pages.erp.product.create');
}


 function save(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->manufacturer_id = $request->manufacturer_id;
        $product->measure = $request->measure;
        $product->type = $request->type;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;

        // handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $product->photo = 'uploads/products/' . $filename;
        }

        $product->save();

        return redirect("product")->with("success", "Product saved successfully");
    }

    // EDIT - show edit form
    function edit($id)
    {
        $product = Product::find($id);
        return view("pages.erp.product.edit", compact("product"));
    }

    // UPDATE - update product
    function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->manufacturer_id = $request->manufacturer_id;
        $product->measure = $request->measure;
        $product->type = $request->type;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;

        // handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $product->photo = 'uploads/products/' . $filename;
        }

        $product->update();

        return redirect("product")->with("success", "Product updated successfully");
    }

    // DELETE - remove product
    function delete($id)
    {
        Product::find($id)->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }











}
