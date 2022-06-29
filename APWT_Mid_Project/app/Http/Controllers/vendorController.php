<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vendorController extends Controller
{
    function __construct(){
        $this->middleware("logged");
    }
    
    function welcome(){return view("public.welcome");}
}
