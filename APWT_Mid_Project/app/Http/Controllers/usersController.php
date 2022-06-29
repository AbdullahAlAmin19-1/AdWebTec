<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\vendor;
use App\Models\customer;
use App\Models\deliveryman;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendOTP;

class usersController extends Controller
{
    function registrationConfirm(Request $vali){
        $this->validate($vali,
            [
                "user_type"=>"required",
                "name"=>"required|regex:/^[A-Z a-z,.-]+$/i",
                "uname"=>"required",
                "email"=>"required|email",
                "phone"=>"required|min:10|max:10",
                "password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:password",
                "gender"=>"required",
                "dob"=>"required",
                "address"=>"required"
            ],
            []
        );
        if($vali->user_type=="Vendor"){$user = new vendor();}
        elseif($vali->user_type=="Customer"){$user = new customer();}
        elseif($vali->user_type=="Deliveryman"){$user = new deliveryman();}
        
        $user->name = $vali->name;
        $user->username = $vali->uname;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->password = $vali->password;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->save();
        session()->flash('msg','Registration Completed');
        return redirect()->route("public.login");
    }

    function loginConfirm(Request $vali){
        $this->validate($vali,
            [
                "user_type"=>"required",
                "email"=>"required|email",
                "password"=>"required|min:8"
            ],
            []
        );
        if($vali->user_type=="Admin"){$user=admin::where('email','=',$vali->email)->where('password',$vali->password)->first();}
        elseif($vali->user_type=="Vendor"){$user=vendor::where('email','=',$vali->email)->where('password',$vali->password)->first();}
        elseif($vali->user_type=="Customer"){$user=customer::where('email','=',$vali->email)->where('password',$vali->password)->first();}
        elseif($vali->user_type=="Deliveryman"){$user=deliveryman::where('email','=',$vali->email)->where('password',$vali->password)->first();}
       
        if($user){
            session()->put('id',$user->id);
            session()->put('user_type',$vali->user_type);

            session()->put('user_name', $user->name);

            if($vali->user_type == "Customer"){
                return redirect()->route("customer.cdashboard");
            }

            elseif($vali->user_type == "Vendor"){
                return redirect()->route("public.welcome");
            }
        }
        else {
            session()->flash('msg','User not valid');
            return back();
        }
    }
    function forgotpassword(Request $vali){
        $this->validate($vali,
            [
                "user_type"=>"required",
                "email"=>"required|email"
            ],
            []
        );
        if($vali->user_type=="Admin"){$user=admin::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Vendor"){$user=vendor::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Customer"){$user=customer::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Deliveryman"){$user=deliveryman::where('email','=',$vali->email)->first();}
       
        if($user){
            session()->put('user_type',$vali->user_type);
            session()->put('email',$user->email);
            return redirect()->route("public.sendOTP");
            //return redirect()->route("public.enterOTP");
        }
        else {
            session()->flash('msg','User not valid');
            return back();
        }
    }
    function enterOTP(Request $vali){
        return view("public.enterOTP");
    }
    function mail(){
        Mail::to(['abdullahalamin1211@gmail.com'])->send(new sendOTP("Demo Mail","1","Tanvir CS AIUB"));
        return redirect()->route("public.enterOTP");
    }
}
