<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //    function index()
    function index(Request $request)

    {


        // return view("customer.index");


        $customer = DB::table("customers")->get();

        // print_r($customers);





        // search

        $customer = Customer::when($request->search, function ($query) use ($request) {
            return $query->whereAny([
                "name",
                "email",
                "id",
            ],"LIKE","%".$request->search."%"
        );
    })->get();



    return view("pages.erp.customer.index", ["customers"=>$customer]);

}






    function create()
    {

        return view("pages.erp.customer.create");
    }

    function save(Request $request)
    {
        print_r($request->all());

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;

        $customer->address = $request->address;
        $customer->photo = $request->photo;
        $customer->save();

        //   echo "saved";
        return redirect("customer");
    }

    function edit($id)
    {
        $customer = Customer::find($id);
        return view("pages.erp.customer.edit", compact("customer"));
    }
    function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;

        $customer->address = $request->address;
        $customer->photo = $request->photo;
        $customer->update();
        return redirect("customer")->with("success", "Customer updated successfully");
    }

    function delete($id)
    {
        Customer::find($id)->delete();
        return redirect()->back()->with('success', 'Customer deleted');
    }
}
