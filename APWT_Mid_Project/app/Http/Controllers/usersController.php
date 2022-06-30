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
                "phone"=>"required|min:11|max:11",
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
            return redirect()->route("public.welcome");
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
            session()->put('username',$user->username);
            session()->put('resetpass','yes');
            return redirect()->route("public.sendOTP");
        }
        else {
            session()->flash('msg','User not valid');
            return back();
        }
    }
    function mail(){
        $otp = random_int(100000, 999999);
        session()->put('otp',$otp);
        Mail::to([Session()->get('email')])->send(new sendOTP("Access OTP",Session()->get('user_type'),Session()->get('username'),Session()->get('email'),Session()->get('otp')));
        return redirect()->route("public.enterOTP");
    }
    function enterOTP(Request $vali){
        if(Session()->get('otp')==$vali->otp){
            session()->put('checkotp','yes');
            return redirect()->route("public.enternewpassword");
        }
        else {
            session()->flash('msg','OTP not valid');
            return back();
        }
    }
    function enternewpassword(Request $vali){
        $this->validate($vali,
            [
                "new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",
            ],
            []
        );
        if(session()->get('user_type')=="Admin"){$user=admin::where('email','=',session()->get('email'))->first();}
        elseif(session()->get('user_type')=="Vendor"){$user=vendor::where('email','=',session()->get('email'))->first();}
        elseif(session()->get('user_type')=="Customer"){$user=customer::where('email','=',session()->get('email'))->first();}
        elseif(session()->get('user_type')=="Deliveryman"){$user=deliveryman::where('email','=',session()->get('email'))->first();}
       
        if($user){
            $user->password = $vali->new_pass;
        $user->update();
        session()->flash('msg','Password Change Completed');
        session()->flush();
        return redirect()->route("public.login");
        }
        else{
            session()->flash('msg','Password Change Failed');
            return back();
        }
        
    }
}
