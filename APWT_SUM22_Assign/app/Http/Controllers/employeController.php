<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employe;
use Illuminate\Support\Facades\Session;

class employeController extends Controller
{
    function loginConfirm(Request $vali){
        $this->validate($vali,
            [
                "email"=>"required|email",
                "password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%]).*$/"
            ],
            []
        );
        $emp=employe::where('email','=',$vali->email)->first();
        if($emp==null){return "Input an email which is already been registered";}
        elseif($emp->type!=$vali->user_type){return "User type invalid";}
        elseif($emp->password!=$vali->password){return "Wrong Password";}
        else{
            if($emp->type=="Admin"){
                //session::put('user_type',$emp->type);
                return redirect()->route("admin.dashboard");
            }
            if($emp->type=="User"){
                //session::put('user_type',$emp->type);
                return redirect()->route("user.dashboard");
            }
        }
    }
    function registrationConfirm(Request $vali){
        $this->validate($vali,
            [
                "name"=>"required|regex:/^[A-Z a-z,.-]+$/i",
                "email"=>"required|email",
                "password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%]).*$/",
                "conf_password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%]).*$/|same:password"
            ],
            []
        );
        $emp = new employe();
        $emp->name = $vali->name;
        $emp->email =$vali->email;
        $emp->password = $vali->password;
        $emp->save();
        return redirect()->route("public.login");
    }
    function userDashboard(){
        $employes = employe::all();
        return view("user.dashboard")->with('employes',$employes);
    }
    function userDetails($id){
        $emp = employe::where('id','=',$id)->first();
        return view('user.details')->with('emp',$emp);
    }
    function adminDashboard(){
        $employes = employe::all();
        return view("admin.dashboard")->with('employes',$employes);
    }
    function adminDetails($id){
        $emp = employe::where('id','=',$id)->first();
        return view('admin.details')->with('emp',$emp);
    }
}