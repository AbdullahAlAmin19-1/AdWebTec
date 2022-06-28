<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagesController extends Controller
{
    function home(){return view("public.home");}
    function login(){return view("public.login");}
    function registration(){return view("public.registration");}
}
