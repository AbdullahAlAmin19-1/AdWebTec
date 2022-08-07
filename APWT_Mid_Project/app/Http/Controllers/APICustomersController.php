<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\customer;
use App\Models\cart;

class APICustomersController extends Controller
{
    function profileinfo($id)
    {
        $customer = [];
        $customer = customer::where('id', '=', $id)->first();
        return response()->json($customer, 200);
    }

    function updateprofile(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "name" => "required",
            //Others validation here

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $c_id = $req->id;
        $customer = customer::find($c_id);

        $customer->username = $req->username;
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->phone = $req->phone;
        $customer->gender = $req->gender;
        $customer->dob = $req->dob;
        $customer->address = $req->address;
        $customer->update();

        return response()->json(
            [
                "msg" => "Updated Successfully",
            ]
        );
    }

    function updatedp(Request $req)
    {
        $no_id = 1;
        $no_username = "MdRasen";

        if ($req->hasfile('file')) {
            $orgName = $req->file->getClientOriginalName();
            $ppName = $no_username . time() . $orgName;
            $req->file->storeAs('public/cprofile_images', $ppName);

            $customer = customer::find($no_id);
            $customer->propic = $ppName;
            $customer->update();
            return response()->json(["msg" => $ppName]);
        }
        return response()->json(["msg" => "No file"]);
    }

    function addcart(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "quantity" => "required",
            //Others validation here

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $c_id = $req->c_id;
        $p_id = $req->p_id;

        $cart = cart::where('p_id', $p_id)->where('c_id', $c_id)->get();

        // return response()->json($cart);

        if (count($cart) != null) {
            $cart = cart::where('p_id', $p_id)->where('c_id', $c_id)->first();
            $cart->quantity = $cart->quantity + $req->quantity;
            $cart->update();

            return response()->json(["msg" => "Product has been added successfully!"]);

        } else {
            $cart = new cart();
            $cart->quantity = $req->quantity;
            $cart->c_id = $c_id;
            $cart->p_id = $req->p_id;
            $cart->save();

            return response()->json(["msg" => "Product has been added successfully!"]);
        }
    }

    function viewcart($id){
        $carts = cart::where('c_id', $id)->get();
        return response()->json($carts);
    }

    function cartproductremove(Request $req){
        $id = $req->cart_id;
        $carts = cart::where('id', $id)->delete();
        return response()->json(["msg" => "Product has been deleted successfully!"]);
    }
}
