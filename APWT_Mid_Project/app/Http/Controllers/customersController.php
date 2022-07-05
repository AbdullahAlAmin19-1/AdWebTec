<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\product;

use Illuminate\Support\Facades\DB;

class customersController extends Controller
{
    function __construct(){
        $this->middleware("logged");
    }
    
    function cdashboard(){
        $p = DB::table('products')->simplePaginate(5);
        return view('customer.cdashboard', compact('p'));
    }

    function cprofileinfo(){
        $id = session()->get('id');
        $customer = [];
        $customer = customer::where('id', '=', $id)->first();

        return view("customer.cprofileinfo")->with('customer', $customer);
    }

    function cprofile(){
        $id = session()->get('id');
        $customer = [];
        $customer = customer::where('id', '=', $id)->first();

        return view("customer.cprofile")->with('customer', $customer);
    }

    function cprofileupdate(Request $req){

        $this->validate($req, [
            // "username" => "required",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email",
            "phone" => "required|max:10|min:10",
            "password" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
            "cpassword" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:password",
            "gender" => "required",
            "dob" => "required",
            "address" => "required"
        ]);
        
        $id = session()->get('id');

        $customer = customer::find($id);

        // $customer->username = $req->username;
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->phone = $req->phone;
        $customer->password = $req->password;
        $customer->gender = $req->gender;
        $customer->dob = $req->dob;
        $customer->address = $req->address;

        $customer->update();

        session()->flash('cupdateMsg','Customer details has been successfully updated!');
        return redirect()->route('customer.cprofile');
    }

    function cppupload(Request $req){

        $this->validate($req, [
            "myPP" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'myPP.required' => 'Please select a picture!',
            'myPP.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
    );
        $id = session()->get('id');
        $username = session()->get('username');

        $extension = $req->file('myPP')->getClientOriginalExtension();

        $ppname = $username.time().".".$extension;

        $req->file('myPP')->storeAs('public/cprofile_images', $ppname);

       
        $customer = customer::find($id);
        $customer->propic = $ppname;
        $customer->update();

        session()->flash('cppupload','Customer profile picture has been successfully updated!');
        return redirect()->route('customer.cprofile');
    }

    function caddcart(Request $req){
        $id = session()->get('id');

        $cart = new cart();
        $cart->quantity = $req->quantity;
        $cart->c_id = $id;
        $cart->p_id = $req->p_id;

        $cart->save();

        session()->flash('addcart','Product has been added in the card!');
        return redirect()->route('customer.cdashboard');
    }

    function ccart(){

        $id = session()->get('id');

        //Using Join
        $products = DB::table('carts')
            ->join('products', 'carts.p_id', '=', 'products.id')
            ->where('carts.c_id', $id)
            ->get();

        return view("customer.ccart")->with('products', $products);
    }

    function cartproductremove($p_id){

        $carts = cart::where('p_id', $p_id)->delete();
        session()->flash('cartRemove', "Product has been removed from the cart!");

        return redirect()->route('customer.ccart');

    }

    function corder(){

        $id = session()->get('id');

        //Using Join
        $products = DB::table('carts')
            ->join('products', 'carts.p_id', '=', 'products.id')
            ->where('carts.c_id', $id)
            ->select('products.*')
            ->get();

        return view("customer.corder")->with('products', $products);
    }

    function corderForm(Request $req){

        session()->flash('corder','Your Order has been successfully placed!');
        return redirect()->route('customer.cdashboard');
    }
}
