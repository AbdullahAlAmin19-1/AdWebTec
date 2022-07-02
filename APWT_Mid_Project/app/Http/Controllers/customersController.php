<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\product;

class customersController extends Controller
{
    function __construct(){
        $this->middleware("logged");
    }
    
    function cdashboard(){

        $products5 = [];
        // $products = product::all();
        $products5 = product::where('p_id', '<=', 5)->get();
        $products10 = product::where('p_id', '>', 5)->where('p_id', '<=', 10)->get();
        return view("customer.cdashboard")->with('products5', $products5)->with('products10', $products10);
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

    function clogout(){
        //Session to clear all
        session()->forget(['id', 'user-type', 'user_name']);

        session()->flash('clogoutMsg','You have been successfully logged out!');
        return redirect()->route('public.home');
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

        echo "Working";
    }
}
