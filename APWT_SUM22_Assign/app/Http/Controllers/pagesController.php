<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagesController extends Controller
{
    function welcome(){
        return view("public.welcome");
    }
    function login(){
        return view("public.login");
    }
    function registration(){
        return view("public.registration");
    }
}
