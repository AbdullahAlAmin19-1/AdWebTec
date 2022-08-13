<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\customer;
use App\Models\cart;
use App\Models\review;

class APICustomersController extends Controller
{
    function __construct(){
        $this->middleware("authUser");
        $this->middleware("customer");
    }
    
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

		// Check Comment
		// Check Comment

    }

    function reviews($id){

        $reviews = review::where('c_id', $id)->where('message', '=', null)->get();
        $previews = review::where('c_id', $id)->where('message', '!=', null)->get();
        
            if(count($reviews) !== 0 || count($previews) !== 0){
                // return view("customer.cProductReview")->with('reviews', $reviews)->with('previews', $previews);
                return response()->json(["reviews" => $reviews, "previews" => $previews]);
            }
    
            else{
                return response()->json(["msg" => "Your do not have any product for review!"]);
            }
    }

    function reviewview($id){
        $review = review::where('id', $id)->first();

        return response()->json($review);
    }

    function reviewupdate(Request $req){
        
        $review = review::find($req->r_id);

        $review->message = $req->r_message;
        $review->update();

        return response()->json(["msg" => "Review has been updated!"]);
    }

    function reviewdelete(Request $req){
        
        $review = review::find($req->r_id);

        $review->message = null;
        $review->update();

        return response()->json(["msg" => "Review has been deleted!"]);
    }
}