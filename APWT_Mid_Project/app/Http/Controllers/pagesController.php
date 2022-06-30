<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagesController extends Controller
{
    function home(){return view("public.home");}
    function login(){return view("public.login");}
    function registration(){return view("public.registration");}
    function logout(){session()->flush();return redirect()->route("public.login");}    
    function forgotpassword(){return view("public.forgotpassword");} 
    function enterOTP(){return view("public.enterOTP");}
    function enternewpassword(){return view("public.enternewpassword");}
}
