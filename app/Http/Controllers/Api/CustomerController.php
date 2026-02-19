<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        // return response()->json(['customers' => $customers], 200);
        return response()->json(compact("customers"), 200);
    }


    public function store(Request $request)
    {
      try {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;


            $imgname = "";
            if ($request->hasFile("photo")) {
                $imgname = $request->name . "." . $request->file("photo")->extension();
                $request->file("photo")->storeAs("photo/customer", $imgname, "public");

                $customer->photo =$imgname;
            }



            $customer->save();
            return response()->json(["success" => "Customer saved successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 200);

        }
    }


    public function show(string $id)
    {
       $customer = Customer::find($id);
        return response()->json(["customer" => $customer], 200);
    }


public function update(Request $request, string $id)
{
    try {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(["error" => "Customer not found"], 404);
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;

        // Handle photo
        if ($request->hasFile('photo')) {
            $imgname = time() . '.' . $request->file('photo')->extension();
            $request->file('photo')->storeAs('photo/customer', $imgname, 'public');
            $customer->photo = $imgname;
        }

        $customer->save();

        return response()->json(["success" => "Customer Updated Successfully"], 200);
    } catch (\Throwable $th) {
        return response()->json(["error" => $th->getMessage()], 500);
    }
}




public function destroy($id)
{
   $customer = Customer::findOrFail($id);

   $customer->delete();
   return response()->json(["success" => "Customer deleted successfully", "data"=>$customer], 200);
}


}
