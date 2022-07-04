<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class pagesController extends Controller
{
    function home(){
        $products5 = [];
        $products10 = [];
        // $products = product::all();
        $products5 = product::where('p_id', '<=', 15)->get();
        $products10 = product::where('p_id', '>', 15)->where('p_id', '<=', 10)->get();
        return view("public.home")->with('products5', $products5)->with('products10', $products10);
    }
    function login(){return view("public.login");}
    function registration(){return view("public.registration");}
    function logout(){session()->flush();return redirect()->route("public.login");}    
    function forgotpassword(){return view("public.forgotpassword");} 
    function enterOTP(){return view("public.enterOTP");}
    function enternewpassword(){return view("public.enternewpassword");}

    function allproducts(){
        $products = [];
        $products = product::all();
        return view("public.allproducts")->with('products', $products);
    }
    
    function products(){
        $p = DB::table('products')->simplePaginate(4);
 
        // return view('vendor.allproducts', compact('p'));
        return view('public.products', compact('p'));
    }
    function searchcategory($category){
        $products = product::where('p_category', '=', "$category")->get();
        return view("public.productsbycategory")->with('products', $products);
    }

    function searchproduct(Request $req){

        $this->validate($req, [
            "search_name" => "required",
        ],
        [
            'search_name.required' => 'Please enter any value!',
        ]
    );
    $search_name = $req->search_name;
    $products= product::where('p_name', 'like', '%'.$search_name.'%')->get();
    return view("public.searchproduct")->with('products', $products);
    }
}
