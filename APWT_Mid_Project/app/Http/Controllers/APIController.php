<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\vendor;
use App\Models\Product;

class APIController extends Controller
{
    function registration(Request $req){
        $validator = Validator::make($req->all(),[
            "name"=>"required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $s = new Vendor();
        $s->name = $req->name;
        $s->username = $req->username;
        $s->email = $req->email;
        $s->phone = $req->phone;
        $s->password = $req->password;
        $s->gender = $req->gender;
        $s->dob = $req->dob;
        $s->address = $req->address;
        $s->save();
        return response()->json(
            [
                "msg"=>"Added Successfully",
                "data"=>$s        
            ]
        );
    }

    //
    function user(){
        $data = product::all();
        return response()->json($data);
    }
    //

    function products(){

        // $products = DB::table('products')->simplePaginate(5); //For Pagination
        $products = Product::all();
 
        // return view('vendor.allproducts', compact('p'));
        // return view('public.products', compact('p'));
        return response()->json($products);
    }

}
