<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendor;

class vendorController extends Controller
{
    function __construct(){
        $this->middleware("logged");
    }
    
    function welcome(){return view("public.welcome");}

    function dashboard(){return view("vendor.dashboard");}

    function profile(){
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user){return view("vendor.profile")->with('vendor',$user);}
        else {return view("vendor.dashboard");}
    }
    function editprofile(){
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user){return view("vendor.editprofile")->with('vendor',$user);}
        else {return view("vendor.dashboard");}
    }
    function editprofileupdate(Request $vali){
        // $this->validate($vali,
        //     [
        //         "user_type"=>"required",
        //         "name"=>"required|regex:/^[A-Z a-z,.-]+$/i",
        //         "uname"=>"required",
        //         "email"=>"required|email",
        //         "phone"=>"required|min:10|max:10",
        //         "password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
        //         "conf_password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:password",
        //         "gender"=>"required",
        //         "dob"=>"required",
        //         "address"=>"required"
        //     ],
        //     []
        // );

        $user=vendor::where('id','=',session()->get('id'))->first();
        // if($user){return view("vendor.profile")->with('vendor',$user);}
        // else {return view("vendor.dashboard");}
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->password = $vali->password;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->update();
        session()->put('user_name', $user->username);
        session()->flash('msg','Update Completed');
        return back();
    }
}
