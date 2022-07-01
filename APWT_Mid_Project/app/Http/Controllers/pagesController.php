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
        $products5 = product::where('p_id', '<=', 5)->get();
        $products10 = product::where('p_id', '>', 5)->where('p_id', '<=', 10)->get();
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
    public function products()
    {
        $p = DB::table('products')->paginate(4);
 
        return view('vendor.allproducts', compact('p'));
    }
}
