<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;

class usersController extends Controller
{
    function registrationConfirm(Request $vali){
        $this->validate($vali,
            [
                "user_type"=>"required",
                "name"=>"required|regex:/^[A-Z a-z,.-]+$/i",
                "uname"=>"required",
                "email"=>"required|email",
                "phone"=>"required|min:11",
                "password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%]).*$/|same:password",
                "gender"=>"required",
                "dob"=>"required",
                "address"=>"required"
            ],
            []
        );
        if($vali->user_type=="Admin"){$user = new admin();}
        elseif($vali->user_type=="Vendor"){$user = new vendor();}
        elseif($vali->user_type=="Customer"){$user = new customer();}
        elseif($vali->user_type=="Deliveryman"){$user = new deliveryman();}
        else{
            session()->flash('msg',"Registration Failed");
            return redirect()->route("public.registration");
        }
        $user->name = $vali->name;
        $user->uname = $vali->uname;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->password = $vali->password;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->save();
        return redirect()->route("public.login");
    }

    function loginConfirm(Request $vali){
        $this->validate($vali,
            [
                "email"=>"required|email",
                "password"=>"required|min:8"
            ],
            []
        );
        if($vali->user_type=="Admin"){$user=admin::where('a_email','=',$vali->email)->first();}
        elseif($vali->user_type=="Vendor"){$user=vendor::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Customer"){$user=customer::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Deliveryman"){$user=deliveryman::where('email','=',$vali->email)->first();}
        else{
            session()->flash('msg',"Login Failed");
            return redirect()->route("public.login");
        }
        if($user==null){
            session()->flash('msg',"Input an email which is already been registered");
            return redirect()->route("public.login");
        }
        elseif($user->a_password!=$vali->password){
            session()->flash('msg',"Wrong Password");
            return redirect()->route("public.login");
        }
        else{
            session()->put('user_type',$vali->user_type);
            return redirect()->route("welcome");
        }
    }
}
