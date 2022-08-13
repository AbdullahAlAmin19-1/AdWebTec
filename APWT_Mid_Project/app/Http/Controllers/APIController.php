<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Datetime;
use App\Models\vendor;
use App\Models\customer;
use App\Models\admin;
use App\Models\req_deliveryman;
use App\Models\Product;
use App\Models\token;

class APIController extends Controller
{
    function registration(Request $req){
        $validator = Validator::make($req->all(),[
            "name"=>"required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        if($req->user_type=="Vendor"){$user = new vendor();}
        elseif($req->user_type=="Customer"){$user = new customer();}
        elseif($req->user_type=="Deliveryman"){$user = new req_deliveryman();}
        $user->name = $req->name;
        $user->username = $req->username;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->password = $req->password;
        $user->gender = $req->gender;
        $user->dob = $req->dob;
        $user->address = $req->address;
        $user->save();
        return response()->json(
            [
                "msg"=>"Added Successfully",
                "data"=>$user        
            ]
        );
    }

    function login(Request $req){
        $validator = Validator::make($req->all(),[
            "email"=>"required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $user=null;
        if($req->user_type=="Admin"){$user=admin::where('email','=',$req->email)->where('password',$req->password)->first();}
        elseif($req->user_type=="Vendor"){$user=vendor::where('email','=',$req->email)->where('password',$req->password)->first();}
        elseif($req->user_type=="Customer"){$user=customer::where('email','=',$req->email)->where('password',$req->password)->first();}
        elseif($req->user_type=="Deliveryman"){$user=req_deliveryman::where('email','=',$req->email)->where('password',$req->password)->first();}
        if($user!=null){
            $key = Str::random(67);
            $token = new token();
            $token->token_key = $key;
            $token->user_id = $user->id;
            $token->user_type = $req->user_type;
            $token->created_at = new Datetime();
            $token->save();
            return response()->json(
                [
                    "msg"=>"Login Successfully",
                    "user_type"=>$req->user_type, 
                    "user"=>$user, 
                    "token"=>$token      
                ]
            );
        }
        else{
            return response()->json(
                [
                    "msg"=>"Login Faild"
                ]
                );
        }
    }

    function logout(Request $req){
        $key = $req->key;
        $token = token::where('token_key',$key)->first();
        $token->expired_at = new Datetime();
        $token->save();
        return response()->json(["msg"=>"Logged out"]);
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

    function viewproduct($id){
        $products =Product::where('id', '=', $id)->first();
        return response()->json($products);
    }

}
