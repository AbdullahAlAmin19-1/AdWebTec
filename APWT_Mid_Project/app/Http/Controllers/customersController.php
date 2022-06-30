<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customersController extends Controller
{
    function cdashboard(){
        return view("customer.cdashboard");
    }
    function cprofile(){

        //Generate details and pass data -> with()
        return view("customer.cprofile");
    }
    function clogout(){
        //Session to clear all
        session()->forget(['id', 'user-type', 'user_name']);

        session()->flash('clogoutMsg','You have been sucessfully logged out!');
        return redirect()->route('public.home');
    }

    function cprofileupdate(Request $req){
        $this->validate($req, [
            "username" => "required",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email",
            "phone" => "required|max:10|min:10",
            "password" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/",
            "cpassword" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|same:password",
            "gender" => "required",
            "dob" => "required",
            "address" => "required"
        ]);
        //update here

        session()->flash('cupdateMsg','Customer details have been sucessfully updated!');
        return redirect()->route('customer.cprofile');
    }
}
